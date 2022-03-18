<template>
  <footer class="p-4 text-center">
    © {{ new Date().getFullYear() }} — {{ $store.state.brand }}  by
    <a href="https://www.wrappixel.com/">{{ $store.state.author }}</a>
  </footer>
</template>

<script>
export default {
  name: "Footer",
};
</script>

<style>
</style>
