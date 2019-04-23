<template>
    <div>
        <div>
            <label class="btn my-btn-secondary btn-sm" id="post_image">
                画像添付(任意)
                <input v-on:change="onFileChange" id="post_image" name="post_image" type="file" style="display:none;">
            </label>
            <div>
                {{ fileName }}
            </div>
        </div>
        <img class="img-thumbnail" style="height:100px; display:block;" v-show="uploadedImage" :src="uploadedImage">
    </div>
</template>

<script>
    export default {
        props: {
            // 親の要素を指定、高さ変更が必要な場合に利用
            parentElementId: [String, Number],
        },
        data() {
            return {
                uploadedImage: "",
                fileName: "",
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
                    this.uploadedImage = "";
                    this.watchHeight();
                }
            },

            // アップロードした画像を表示
            createImage(file) {
                let reader = new FileReader();
                reader.onload = (e) => {
                    this.uploadedImage = e.target.result;
                    this.watchHeight();
                };
                reader.readAsDataURL(file);
                this.fileName = file.name;
            },

            // 必要な場合は、画像表示でエリアの高さ変わるので
            // 高さを再調整する
            watchHeight() {
                if (this.parentElementId) {
                    this.$nextTick(function () {
                        var el = document.getElementById(this.parentElementId);
                        el.style.height = el.scrollHeight + 'px';
                    });
                }
            }
        },
    }
</script>
