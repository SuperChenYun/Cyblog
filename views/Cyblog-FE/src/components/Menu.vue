<template>
    <div class="header">
        <b-container>
            <b-navbar toggleable="lg" type="light" variant="light">
                <b-navbar-brand :href="nowDomain">
                    <img src="http://192.168.1.11/static/img/2.jpg" width="50rem" class="d-inline-block align-top" alt="BV" />
                    CyBlog
                </b-navbar-brand>
                <!-- 手机菜单展开按钮 -->
                <b-navbar-toggle target="nav_collapse" />
                <!-- 菜单 -->
                <b-collapse is-nav id="nav_collapse">
                    <b-navbar-nav>
                        <b-nav-item href="#/">Blog</b-nav-item>
                        <b-nav-item href="#/timeline">Timeline</b-nav-item>
                        <b-nav-item href="#/experiment">Experiment</b-nav-item>
                        <b-nav-item href="#/about">About</b-nav-item>
                    </b-navbar-nav>

                    <!-- Right aligned nav items -->
                    <b-navbar-nav class="ml-auto">
                        <b-nav-form>
                            <b-form-input size="sm" class="mr-sm-2" type="text" placeholder="Search" />
                            <b-button size="sm" class="my-2 my-sm-0" type="submit">Search</b-button>
                        </b-nav-form>
                    </b-navbar-nav>
                </b-collapse>
            </b-navbar>
        </b-container>
    </div>
</template>

<script>
export default {
    data () {
        return {
        }
    },
    // 初始化
    created () {
    },
    methods: {
    },
    computed: {
        nowDomain: function () {
            return window.location.origin
        }
    }
}
</script>

<style lang="less" scoped>
    .header {
        background: #f8f9fa;
        box-shadow:0 0 6px #e4e4e4;
    }
</style>
