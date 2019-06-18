<template>
  <v-content>
    <v-container>
      <v-card>
        <v-card-title primary-title>
          <div>
            <h4 class="headline mb-0">Invite New Agent</h4>
          </div>
        </v-card-title>
      </v-card>
      <v-card>
        <v-card-title primary-title>
          <div>
            <h5 class="headline mb-0">Your Reference Code is {{ user["id"] }}</h5>
            <a
              :href="'http://meeraacle-pwa.test/register/'+user['id']"
            >{{ 'http://meeraacle-pwa.test/register/'+user["id"] }}</a>
          </div>
        </v-card-title>
      </v-card>
    </v-container>
  </v-content>
</template>
<script>
import axios from "axios";
import { mapGetters, mapActions } from "vuex";
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
    this.$store.dispatch("loadUser");
  },
  computed: {
    ...mapGetters({
      user: "user"
    })
  },
  methods: {}
};
</script>
