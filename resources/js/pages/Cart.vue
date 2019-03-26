<template>
  <v-content>
    <v-container>
      <v-card>
        <v-card-title primary-title>
          <div>
            <h4 class="headline mb-0">Your Cart</h4>
          </div>
        </v-card-title>
        <p v-show="!products.length">
          <i>Your cart is empty!</i>
          <router-link to="sell">Go Sell</router-link>
        </p>
        <table class="table is-striped" v-show="products.length">
          <thead>
            <tr>
              <td>Name</td>
              <td>Serial</td>
              <td>Quantity</td>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(p, index) in products" :key="index">
              <td>{{ p.product.name }}</td>
              <td>{{ p.serial }}</td>
              <td>{{ p.quantity }}</td>
            </tr>
            <tr>
              <td>
                <b>Total:</b>
              </td>
              <td></td>
              <td>
                <b>{{ total }}</b>
              </td>
            </tr>
          </tbody>
        </table>
      </v-card>
      <v-card v-show="products.length">
        <v-card-title primary-title>
          <div>
            <h6 class="headline mb-0">Buyer Details</h6>
          </div>
        </v-card-title>
        <v-form>
          <v-text-field v-model="name" label="Customer Name"></v-text-field>

          <v-text-field v-model="email" label="E-mail" required></v-text-field>
          <p>
            <v-btn @click="checkout">Checkout</v-btn>
          </p>
        </v-form>
      </v-card>
    </v-container>
  </v-content>
</template>
<script>
import { mapGetters } from "vuex";
export default {
  computed: {
    ...mapGetters({
      products: "cartProducts"
    }),
    total() {
      return this.products.reduce((total, p) => {
        return total + p.quantity;
      }, 0);
    }
  },
  methods: {
    checkout() {}
  }
};
</script>
