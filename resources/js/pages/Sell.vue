<template>
  <v-content>
    <v-container style="position: relative;top: 1%;" class="text-xs-center">
      <qrcode-stream @decode="onDecode()"></qrcode-stream>
      <v-form ref="form" v-model="valid" lazy-validation>
        <v-text-field v-model="serial" label="Serial Number" required></v-text-field>
        <v-select
          :items="items"
          item-value="id"
          item-text="name"
          label="Product"
          v-model="product"
          required
          @change="check"
        ></v-select>
        <v-btn primary large block @click="addToCart({id:product, serial})">Add To Cart</v-btn>
      </v-form>
    </v-container>
  </v-content>
</template>
<script>
import axios from "axios";
import { mapGetters, mapActions } from "vuex";
export default {
  computed: mapGetters({
    products: "allProducts",
    length: "getNumberOfProducts"
  }),
  data() {
    return {
      valid: true,
      url: "",
      serial: "",
      product: "",
      store: 0,
      items: [
        { id: "1", name: "Meeracle Gemstone Serum" },
        { id: "2", name: "Meeracle Gemstone Cleanser" }
      ]
    };
  },
  methods: {
    ...mapActions(["addToCart"]),
    check() {
      console.log(this.product);
    },
    onDecode(decodedString) {
      let self = this;
      console.log(decodedString);
      this.serial = decodedString;
      axios
        .post("/serial/", {
          url: decodedString
        })
        .then(function(response) {
          // handle success
          self.serial = response.data.serial;
        })
        .catch(function(error) {
          // handle error
          console.log(error);
        })
        .then(function() {
          // always executed
        });
    },
    addCart({ id, name }) {
      if (this.$refs.form.validate()) {
        this.snackbar = true;
      } else {
        this.product = this.serial = "";
        this.addToCart({ id, name });
      }
    }
  }
};
</script>
