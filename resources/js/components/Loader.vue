<template>
    <div class="ring-loader">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
</template>

<script>
export default {
    name: "Loader"
}
</script>

<style scoped>
    .ring-loader {
        display: inline-block;
        position: relative;
        width: 20px;
        height: 20px;
        margin-right: 10px;
    }
    .ring-loader div {
        box-sizing: border-box;
        display: block;
        position: absolute;
        width: 20px;
        height: 20px;
        border: 3px solid #cef;
        border-radius: 50%;
        animation: ring-loader 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
        border-color: #cef transparent transparent transparent;
    }
    .ring-loader div:nth-child(1) {
        animation-delay: -0.45s;
    }
    .ring-loader div:nth-child(2) {
        animation-delay: -0.3s;
    }
    .ring-loader div:nth-child(3) {
        animation-delay: -0.15s;
    }
    @keyframes ring-loader {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }
</style>
