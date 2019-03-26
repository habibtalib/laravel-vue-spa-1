<template>
  <v-content>
    <v-carousel>
      <v-carousel-item
        v-for="(item,i) in items"
        :key="i"
        :src="item.src"
        reverse-transition="fade"
        transition="fade"
        style="background-color:#bf1f31;"
      >
        <v-responsive dark>
          <v-container fill-height>
            <v-layout align-center>
              <v-flex>
                <h4>{{item.title}}</h4>
                <span>{{item.desc}}</span>
              </v-flex>
            </v-layout>
          </v-container>
        </v-responsive>
      </v-carousel-item>
    </v-carousel>
  </v-content>
</template>
<script>
export default {
  data() {
    return {
      items: [
        {
          src: "/images/product-07.png",
          title: "Meeracle Gemstone Cleanser",
          desc: "Cleaner than ever."
        },
        {
          src: "/images/product-08.png",
          title: "Meeracle Gemstone Serum",
          desc: "Fast result."
        }
      ]
    };
  },
  components: {}
};
</script>
