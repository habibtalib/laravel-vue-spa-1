<template>
  <v-content>
    <v-container>
      <v-layout justify-center wrap>
        <v-flex xs12 md8>
          <material-card color="green">
            <v-form>
              <v-container py-0>
                <v-layout wrap>
                  <v-flex xs12 md4>
                    <v-text-field label="Membership ID" disabled :value="'MEE' + user.id"/>
                  </v-flex>
                  <v-flex xs12 md4>
                    <v-text-field
                      class="purple-input"
                      disabled
                      label="Full Name"
                      v-model="user.name"
                    />
                  </v-flex>
                  <v-flex xs12 md4>
                    <v-text-field label="Email Address" class="purple-input" v-model="user.email"/>
                  </v-flex>
                  <v-flex xs12 md12>
                    <v-textarea label="Adress" class="purple-input" v-model="user.address"/>
                  </v-flex>
                  <v-flex xs12 md4>
                    <v-text-field label="City" class="purple-input" v-model="user.city"/>
                  </v-flex>
                  <v-flex xs12 md4>
                    <v-text-field
                      label="Country"
                      class="purple-input"
                      :value="user.country || 'Malaysia'"
                    />
                  </v-flex>
                  <v-flex xs12 md4>
                    <v-text-field
                      class="purple-input"
                      label="Postal Code"
                      type="number"
                      v-model="user.postcode"
                    />
                  </v-flex>
                  <v-flex xs12 text-xs-right>
                    <v-btn class="mx-0 font-weight-light" color="success">Update Profile</v-btn>
                  </v-flex>
                </v-layout>
              </v-container>
            </v-form>
          </material-card>
        </v-flex>
        <v-flex xs12 md4>
          <material-card class="v-card-profile">
            <v-avatar slot="offset" class="mx-auto d-block" size="130">
              <img
                src="https://demos.creative-tim.com/vue-material-dashboard/img/marc.aba54d65.jpg"
              >
            </v-avatar>
            <v-card-text class="text-xs-center">
              <h6 class="category text-gray font-weight-thin mb-3">Level</h6>
              <h4 class="card-title font-weight-light">Agent Pearl</h4>
              <v-btn
                class="mx-0 font-weight-light"
                color="success"
                @click="openDialog()"
              >Upgrade Membership</v-btn>
              <!--<p
                class="card-description font-weight-light"
              >Don't be scared of the truth because we need to restart the human foundation in truth And I love you like Kanye loves Kanye I love Rick Owens’ bed design but the back is...</p>
              <v-btn color="success" round class="font-weight-light">Follow</v-btn>-->
            </v-card-text>
          </material-card>
        </v-flex>
        <v-dialog v-model="dialog" max-width="290">
          <v-card>
            <v-card-title class="headline">Are You Sure You Want to Upgrade?</v-card-title>

            <v-card-text>Your application will be submitted to your team leader for review.</v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>

              <v-btn color="green darken-1" flat="flat" @click="dialog = false">Cancel</v-btn>

              <v-btn color="green darken-1" flat="flat" @click="dialog = false">Confirm</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-layout>
    </v-container>
  </v-content>
</template>

<script>
import materialCard from "../components/material/Card";
import { mapGetters } from "vuex";
export default {
  components: {
    materialCard
  },
  data() {
    return {
      user: {},
      dialog: false
    };
  },
  methods: {
    filterProduct: function(id) {
      return this.products.find(product => product.id === id);
    },
    openDialog: function() {
      this.dialog = true;
    }
  },
  filters: {},
  created() {
    this.dialog = false;
    // this.$store.dispatch("loadMerhandise");
    let self = this;
    axios
      .get("/user")
      .then(function(response) {
        // handle success
        self.user = response.data.user;
        console.log(response);
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
      products: "allProducts"
    })
  }
};
</script>
