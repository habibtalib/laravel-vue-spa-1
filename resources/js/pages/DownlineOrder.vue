<template>
  <v-content>
    <v-container>
      <v-card>
        <v-card-title primary-title>
          <div>
            <h4 class="headline mb-0">Pending Orders</h4>
          </div>
        </v-card-title>
        <table class="table is-striped">
          <thead>
            <tr>
              <td>Buyer</td>
              <td>Date / Time</td>
              <td>Total (RM)</td>
              <td>Status</td>
              <td>Action</td>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(order, index) in orders" :key="index">
              <td>
                <a :href="'/user/'+ order.user_id">{{ order.user_id }}</a>
              </td>
              <td>{{ order.created_at }}</td>
              <td>{{ order.total }}</td>
              <td>{{ order.status }}</td>
              <td>
                <a :href="'/order/'+order.id">View</a>
              </td>
            </tr>
          </tbody>
        </table>
      </v-card>
      <v-card>
        <v-card-title primary-title>
          <div>
            <h4 class="headline mb-0">Completed Orders</h4>
          </div>
        </v-card-title>
        <table class="table is-striped">
          <thead>
            <tr>
              <td>Buyer</td>
              <td>Date / Time</td>
              <td>Total (RM)</td>
              <td>Status</td>
              <td>Action</td>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(order, index) in orders" :key="index">
              <td v-if="index===0">Norazman Nordin</td>
              <td v-else>Fatimah Abadullah</td>
              <td>{{ order.created_at }}</td>
              <td>{{ order.total }}</td>
              <td>{{ order.status }}</td>
              <td>
                <a :href="'/order/'+order.id">View</a>
              </td>
            </tr>
          </tbody>
        </table>
      </v-card>
    </v-container>
  </v-content>
</template>
<script>
import axios from "axios";
import { mapGetters, mapActions } from "vuex";
export default {
  computed: {
    ...mapGetters({
      orders: "orders"
    })
  },
  created() {
    this.$store.dispatch("loadDownlineOrders");
  },
  data() {
    return {
      valid: true,
      url: "",
      serial: "",
      product: "",
      store: 0
    };
  },
  methods: {
    ...mapActions(["addToCart"])
  }
};
</script>
