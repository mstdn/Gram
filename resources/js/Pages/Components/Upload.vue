<template>
    <div>
        <form @submit.prevent="submit()">
            <div v-if="media.length" class="grid gap-2" :class="{'grid-cols-2':media.length > 1}">
                <div class="relative flex flex-col items-center justify-center" v-for="(item, index) in media">
                    <button @click="removeMedia(index, item)" type="button"
                        class="m-1 absolute top-0 left-0 text-white bg-black bg-opacity-50 rounded-full cursor-pointer hover:bg-opacity-100 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                    <img :src="item.url" class="rounded-xl object-cover w-full h-48" />
                    <div class="absolute bg-black bg-opacity-75 text-sm rounded px-2 text-white" v-if="item.loading">
                        Loading..</div>
                </div>
            </div>
            <div class="mt-2">
                <file-input @input="uploadMedia"></file-input>
            </div>
            <div class="mt-4">
                <resize-textarea v-model="form.description" :rows="3" :maxHeight="300"
                    class="textarea textarea-primary w-full focus:border-transparent focus:ring-0 bg-white text-gray-900 dark:bg-gray-900 dark:text-white"
                    placeholder="Add a description"></resize-textarea>
            </div>
            <div class="flex justify-between">
                <div></div>
                <div class="flex justify-end dark:text-white mr-2 mt-2 text-sm"
                    :class="{ 'text-red-600 dark:text-red-600' : remainingChars < 0 }">
                    {{remainingChars}}
                </div>
            </div>
            <div class="flex text-sm text-red-500" v-if="$page.props.errors.description">{{
            $page.props.errors.description }}</div>
            <div class="mt-4">
                <div class="flex justify-between">
                    <select v-model="form.category" name="category" id="category"
                        class="select select-bordered w-full bg-white text-gray-900 dark:bg-gray-900 dark:text-white">
                        <option disabled value="">Category</option>
                        <option v-for="category in $page.props.categories" :key="category.id" :value="category.id"
                            selected>{{ category.name }}</option>
                    </select>
                </div>
            </div>
            <div class="mt-4">
                <div class="flex justify-end">
                    <button v-if="!loading" class="btn btn-secondary" type="submit" :disabled="!canSubmit">
                        Post
                    </button>
                    <button v-else class="btn loading" type="submit" :disabled="!canSubmit">

                    </button>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
import axios from "axios";
import FileInput from "./FileInput.vue";
export default {
    data() {
        return {
            loading: false,
            form: {
                description: "",
                category: "1",
                mediaIds: []
            },
            media: []
        };
    },
    methods: {
        removeMedia(index, item) {
            this.media.splice(index, 1);

            if(item.id) {
                axios.delete(`media/${item.id}`)
                .catch((e) => {
                    console.log(e);
                    this.media.splice(index, 0, item);
                });
            }
        },
        submit() {
            this.form.mediaIds = this.media.map(item => item.id);
            this.$inertia.post(`/upload`, this.form, { 
                preserveState: true,
                onStart: () => this.loading = true,
                onFinish: () => this.loading = false,
                onSuccess: () => {
                    if(Object.keys(this.$page.props.errors).length === 0) {
                        this.form = {description: '', mediaIds: [], category: ''};
                        this.media = [];
                        //this.isOpen.value = false;
                    }
                }
             });
        },
        uploadMedia(files) {

            Array.from(files).forEach((media) => {
                let reader = new FileReader();
                reader.readAsDataURL(media);

                reader.onload = (e) => {

                    let item = {
                        url: e.target.result,
                        id: undefined,
                        loading: true
                    }
                    
                    let formData = new FormData();
                    formData.append('file', media);
                    axios.post('media', formData)
                    .then(({data}) => {
                        item.id = data.id
                    }).finally(() => item.loading = false);

                    this.media.push(item);
                }
            })
        }
    },
    computed: {
        remainingChars() {
            return 500 - this.form.description.length;
        },
        canSubmit() {
            return this.form.description.length && this.remainingChars >= 0 && this.media.every(item => !item.loading);
        }
    },
    components: { FileInput }
}
</script>
<style scoped>
button:disabled {
    opacity: 75%;
    cursor: not-allowed;
}
</style>