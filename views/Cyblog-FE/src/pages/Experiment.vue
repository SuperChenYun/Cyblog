<template>
    <div class="experiment">
        <view-menu/>
        <b-container>
            <ul class="list">
                <li><view-block /></li>
                <li><view-block /></li>
                <li><view-block /></li>
                <li><view-block /></li>
                <li><view-block /></li>
                <li><view-block /></li>
                <li><view-block /></li>
                <li><view-block /></li>
                <li><view-block /></li>
                <li><view-block /></li>
                <li><view-block /></li>
                <li><view-block /></li>
                <li><view-block /></li>
                <li><view-block /></li>
                <li><view-block /></li>
                <li><view-block /></li>
                <li><view-block /></li>
                <li><view-block /></li>
                <li><view-block /></li>
            </ul>
        </b-container>
        <view-footer/>
    </div>
</template>

<script>
import Menu from '../components/Menu'
import Footer from '../components/Footer'
import Block from '../components/Block'
export default {
    components: {
        'view-menu': Menu,
        'view-footer': Footer,
        'view-block': Block
    }
}
</script>

<style lang="less" scoped>
    .list {
        width: 100%;
        margin-bottom: 5rem;
        & li{
            width:23%;
            margin-right: 2%;
        }
        & li:nth-child(4n) {
            margin-right: 0%;
        }
    }
</style>
