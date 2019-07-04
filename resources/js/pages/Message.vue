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
              <td>Status</td>
              <td>Action</td>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(p, index) in orders" :key="index">
              <td>{{ p.created_at }}</td>
              <td>{{ p.total }}</td>
              <td>{{ p.status | filterStatus}}</td>
              <td>
                <a :href="'/history/'+p.id">View</a>
              </td>
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
    this.$store.dispatch("loadOrders");
  },
  filters: {
    filterStatus: function(value) {
      if (value === 1) {
        return "Pending Payment";
      }
      if (value === 2) {
        return "Paid";
      }
      if (value === 3) {
        return "Shipped";
      }
    }
  },
  computed: {
    ...mapGetters({
      orders: "orders"
    })
  },
  methods: {}
};
</script>
