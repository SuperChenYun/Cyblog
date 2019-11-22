<template>
  <div id="app">
    <router-view/>
  </div>
</template>

<script>
export default {
    name: 'App',
    // app 启动时候调用的函数
    created () {
    }
}
</script>

<style>
  html,body,div,ul,li,span,strong,h1,h2,h3,h4,h5,h6 {
    margin: 0;
    padding: 0;
  }
  ul,li{
    list-style: none;
    display: inline-block
  }
  a, a:hover, a:visited {
    color: #333333;
    text-decoration-line: none;
  }
  a:hover{
    color: #333333;
    text-decoration-line:initial
  }
  #app {
    /* font-family: 'Avenir', 'Microsoft YaHei', Helvetica, Arial, sans-serif; */
    font-family: "Helvetica Neue,Helvetica,PingFang SC,Hiragino Sans GB,Microsoft YaHei,\\5FAE\8F6F\96C5\9ED1,Arial,sans-serif" !important;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    /* text-align: center; */
    color: #2c3e50;
    margin: 0;
    padding: 0;
    background: #efefee;
  }
  .iconfont{
    font-size: 1.4rem;
    display: inline-block;
    transform: translateY(0.2rem)
  }
  .container,.container-fluid{
    padding: 0;
  }
  *, :after, :before {
    content: "";
  }
</style>
