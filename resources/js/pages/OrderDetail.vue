<template>
  <v-content>
    <v-container>Order Detail {{ $route.params.id }}</v-container>
  </v-content>
</template>
<script>
export default {
  mounted() {
    console.log(this.$route.params.id);
  }
};
</script>
