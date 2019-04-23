<template>
    <div class="text-right">
        <div class="btn btn-sm" v-bind:class="getBtnClass()" v-on:click="voteAction">
            <i class="far fa-thumbs-up my-vote-icon"></i>
            Good <strong>{{ voteDisplay }}</strong>
        </div>
        <div class="alert alert-warning mt-2 mb-0" v-if="errorFlag">{{ errorMessage }}</div>
    </div>
</template>

<script>
    export default {
        props: {
            vote: [String, Number],
            commentId: [String, Number],
        },
        data: function () {
            return {
                voteDisplay: this.vote,
                clickFlag: false,
                errorFlag: false,
                errorMessage: ""
            }
        },
        methods: {
            // voteをpostする処理
            voteAction() {
                // voteするコメントID
                const params = {
                    id: this.commentId,
                };

                // クリックされてなければ処理する
                if (this.clickFlag === false) {
                    // クリック済みにする
                    // 連打防止のため処理前にフラグを切り替える
                    this.clickFlag = !this.clickFlag

                    axios.post("/comments/vote", params)
                        .then((response) => {
                            // 更新されたvoteを書き込む
                            this.voteDisplay = response.data;
                        }).catch(error => {
                            this.errorFlag = true;
                            if (error.response.status == 401) {
                                this.errorMessage = "goodにはログインが必要です。";
                            } else if (error.response.status == 403) {
                                this.errorMessage = error.response.data.message;
                            } else {
                                this.errorMessage = "投票エラーになります。";
                            }
                        }).finally(() => {
                            //
                        });

                }
            },

            // vote状況でクラスを適用
            getBtnClass() {
                // 3通りのクラス、
                // クリック前、クリック済み、クリック済みでエラー
                return {
                    'btn-outline-info': !this.clickFlag,
                    'btn-info text-light': this.clickFlag && !this.errorFlag,
                    'btn-outline-danger': this.clickFlag && this.errorFlag
                }
            }
        }
    };
</script>
