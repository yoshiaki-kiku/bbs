<template>
    <div class="btn btn-outline-info btn-sm">
        <i class="far fa-thumbs-up my-vote-icon"></i>
        Good <strong>{{ vote }}</strong>
    </div>
</template>

<script>
    export default {
        props: ["vote"],
        mounted() {
            console.log("ExampleComponent mounted.");
        }
    };
</script>
