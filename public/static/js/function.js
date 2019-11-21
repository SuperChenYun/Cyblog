/**
 * Created by itzcy on 17-8-10.
 */
function jump_url(url){
    window.location.href = url;
}
function msg(content){
    layer.msg(content)
}
// 设置 highlight
document.querySelectorAll('pre').forEach((block) => {
    hljs.highlightBlock(block);
});