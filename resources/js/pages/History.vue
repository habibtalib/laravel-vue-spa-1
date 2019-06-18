<template>
  <v-content>
    <v-container>
      <v-card>
        <v-card-title primary-title>
          <div>
            <h4 class="headline mb-0">Order History</h4>
          </div>
        </v-card-title>
        <table class="table is-striped">
          <thead>
            <tr>
              <td>Date / Time</td>
              <td>Total (RM)</td>
              <td>Action</td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>12th June 2019 18:50 P.M</td>
              <td>2,000</td>
              <td>
                <a href="/history/1">View</a>
              </td>
            </tr>
            <tr v-for="(p, index) in orders" :key="index">
              <td>
                {{ p.product.name }}
                <a style="color:blue" @click="remove(p)">remove</a>
              </td>
              <td></td>
              <td></td>
            </tr>
          </tbody>
        </table>
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
      downline_id: ""
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
    remove(product) {
      this.$store.dispatch("removeCart", product);
    },
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
