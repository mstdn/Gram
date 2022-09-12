<template>
    <div>
        
    </div>
</template>
<script>
export default {
    created() {
        window.Echo.private(`App.Models.User.${this.$page.props.user.id}`)
        .notification((notification) => {
            console.log(notification);
        });
    }
}
</script>