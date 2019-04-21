<template>
    <div class="form-group w-50">
        <div class="custom-file">
            <input v-on:change="onFileChange" type="file" class="custom-file-input" id="customFile" lang="ja">
            <label class="custom-file-label" for="customFile">{{ fileName }}</label>
        </div>
        <img class="img-thumbnail" style="height:100px;" v-show="uploadedImage" :src="uploadedImage">
    </div>
</template>

<script>
    export default {
        data() {
            return {
                uploadedImage: "",
                fileName: "ファイル選択...",
            }
        },
        methods: {
            onFileChange(e) {
                let file = e.target.files || e.dataTransfer.files;
                // filetypeの判定
                if (file[0].type.match('image.*')) {
                    this.createImage(file[0]);
                } else {
                    this.fileName = "画像ファイルではありません";
                }
            },
            // アップロードした画像を表示
            createImage(file) {
                let reader = new FileReader();
                reader.onload = (e) => {
                    console.log(e);
                    this.uploadedImage = e.target.result;
                };
                reader.readAsDataURL(file);
                this.fileName = file.name;
            },
        },
    }
</script>
