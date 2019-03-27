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
          <router-link to="sell">Go Scan Product</router-link>or
          <router-link to="merchandise">Go Sell Merchandise</router-link>
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
          <v-select
            prepend-icon="people"
            :items="downline"
            item-text="name"
            item-value="id"
            v-model="downline_id"
            label="Downline"
          ></v-select>
          <v-text-field prepend-icon="people" v-model="name" label="Customer Name"></v-text-field>
          <v-text-field prepend-icon="person" v-model="phone" label="Phone Number" required></v-text-field>
          <v-text-field prepend-icon="people" v-model="email" label="E-mail" required></v-text-field>
          <v-text-field prepend-icon="map" v-model="city" label="City" type="text"></v-text-field>
          <v-text-field prepend-icon="map" v-model="province" label="Porvince" type="text"></v-text-field>
          <v-select
            prepend-icon="map"
            :items="states"
            item-text="value"
            item-value="key"
            v-model="state"
            label="States"
          ></v-select>
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
  data() {
    return {
      email: "",
      name: "",
      phone: "",
      city: "",
      state: "",
      province: "",
      downline: [],
      downline_id: "",
      states: [
        { key: 1, value: "Wilayah Persekutuan" },
        { key: 2, value: "Selangor" },
        { key: 3, value: "Pahang" },
        { key: 4, value: "Perak" },
        { key: 5, value: "Kelantan" },
        { key: 6, value: "Kedah" },
        { key: 7, value: "Negeri Sembilan" }
      ]
    };
  },
  created() {
    let self = this;
    axios
      .get("/downline/")
      .then(function(response) {
        // handle success
        self.downline = response.data.user;
      })
      .catch(function(error) {
        // handle error
        console.log(error);
      })
      .then(function() {
        // always executed
      });
  },
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
    checkout() {
      axios.post("/checkout/"),
        {
          products,
          downline_id,
          name,
          email,
          city,
          state,
          province
        }
          .then(function(response) {
            // handle success
            self.downline = response.data.user;
          })
          .catch(function(error) {
            // handle error
            console.log(error);
          })
          .then(function() {
            // always executed
          });
    }
  }
};
</script>
