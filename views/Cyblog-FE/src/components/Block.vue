<template>
    <div class="block">
        <img src="http://192.168.1.11/static/img/2.jpg" alt="">
        <p>哈哈哈哈哈哈哈哈哈哈或</p>
    </div>
</template>

<script>
export default {
}
</script>

<style lang="less" scoped>
    .block{
        width: 100%;
        text-align: center;
        padding: 0 0 0.333rem 0;
        background: #ffffff;
        box-shadow: 2px 4px 2px #e6e6e6;
        margin: 1.6rem 0 0.5rem 0;
        cursor: pointer;
        & img{
            width: 100%;
        }
        & p {
            line-height: 2.5rem;
        }
    }
    .block:hover{
        transform: translateX(-1px) translateY(-1px);
        animation: all 0.3s ease-in-out;
    }
</style>
