<template>
  <v-content>
    <v-container class="text-xs-center">
      <div class="alert alert-danger" v-if="has_error && !success">
        <p
          v-if="error == 'registration_validation_error'"
        >Validation Error, Please Enter Valid Information. {{errors}}</p>
        <p
          v-else
        >Error, System facing an issue at the moment. Please Contact Administrator {{errors}}</p>
      </div>
      <v-stepper v-model="e1" vertical>
        <v-stepper-step step="1" complete>User Information</v-stepper-step>
        <v-stepper-content step="1">
          <v-card class="mb-5" color="#bf1f31">
            <v-text-field prepend-icon="person" v-model="name" label="Full Name" required></v-text-field>
            <v-text-field
              prepend-icon="mail"
              v-model="email"
              autocomplete="off"
              label="Email"
              required
            ></v-text-field>
            <v-text-field prepend-icon="person" v-model="phone" label="Phone Number" required></v-text-field>
            <v-text-field prepend-icon="lock" v-model="nric" label="MyKad Number" type="text"></v-text-field>
            <!-- <img :src="imageUrl" height="150" v-if="imageUrl">
            <v-text-field
              label="Upload Photo"
              @click="pickFile"
              v-model="imageName"
              prepend-icon="attach_file"
            ></v-text-field>
            <input
              type="file"
              multiple
              style="display: none"
              ref="image"
              accept="image/*"
              @change="onFilePicked"
            >-->
            <v-text-field
              prepend-icon="lock"
              v-model="password"
              autocomplete="false"
              label="Password"
              type="password"
            ></v-text-field>
            <v-text-field
              prepend-icon="lock"
              v-model="password_confirmation"
              autocomplete="false"
              label="Confirm Password"
              type="password"
            ></v-text-field>
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
          </v-card>

          <v-btn color="primary" @click="e1 = 2">Next</v-btn>

          <v-btn flat>Cancel</v-btn>
        </v-stepper-content>
        <v-stepper-step step="2" complete>Referals</v-stepper-step>
        <v-stepper-content step="2">
          <v-card class="mb-5" color="#bf1f31" height="200px">
            <v-text-field prepend-icon="person" v-model="leader_name" label="Leader Name" required></v-text-field>
            <v-text-field
              prepend-icon="person"
              v-model="leader_phone"
              label="Leader Phone Number"
              required
            ></v-text-field>
            <v-select
              prepend-icon="person"
              :items="masterStockist"
              label="Master Stockist"
              item-value="id"
              item-text="value"
              v-model="master_stockist"
              single-line
              bottom
            ></v-select>
          </v-card>

          <v-btn color="primary" @click="register">Submit</v-btn>

          <v-btn flat @click="e1 = 1">Previous</v-btn>
        </v-stepper-content>
      </v-stepper>
    </v-container>
  </v-content>
  <!-- <div class="container">
        <div class="card card-default">
            <div class="card-header">Inscription</div>

            <div class="card-body">
                <div class="alert alert-danger" v-if="has_error && !success">
                    <p v-if="error == 'registration_validation_error'">Erreur(s) de validation, veuillez consulter le(s) message(s) ci-dessous.</p>
                    <p v-else>Erreur, impossible de s'inscrire pour le moment. Si le problème persiste, veuillez contacter un administrateur.</p>
                </div>

                <form autocomplete="off" @submit.prevent="register" v-if="!success" method="post">

                    <div class="form-group" v-bind:class="{ 'has-error': has_error && errors.email }">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" class="form-control" placeholder="user@example.com" v-model="email">
                        <span class="help-block" v-if="has_error && errors.email">{{ errors.email }}</span>
                    </div>

                    <div class="form-group" v-bind:class="{ 'has-error': has_error && errors.password }">
                        <label for="password">Mot de passe</label>
                        <input type="password" id="password" class="form-control" v-model="password">
                        <span class="help-block" v-if="has_error && errors.password">{{ errors.password }}</span>
                    </div>

                    <div class="form-group" v-bind:class="{ 'has-error': has_error && errors.password }">
                        <label for="password_confirmation">Confirmation mot de passe</label>
                        <input type="password" id="password_confirmation" class="form-control" v-model="password_confirmation">
                    </div>

                    <button type="submit" class="btn btn-default">Inscription</button>
                </form>
            </div>
        </div>
  </div>-->
</template>
<script>
export default {
  data() {
    return {
      name: "",
      e1: 0,
      email: "",
      password: "",
      valid: true,
      password_confirmation: "",
      city: "",
      phone: "",
      nric: "",
      province: "",
      has_error: false,
      error: "",
      errors: {},
      success: false,
      imageName: "",
      imageUrl: "",
      imageFile: "",
      masterStockist: [
        { id: 0, value: "HQ" },
        { id: 1, value: "Master Stockist Wan Zira" },
        { id: 2, value: "Master Stockist Siti Khuzaimah" },
        { id: 3, value: "Master Stockist Eddy Syamsinoor" },
        { id: 4, value: "Master Stockist Siti Arfah" },
        { id: 5, value: "Master Stockist Siti Azlina" },
        { id: 6, value: "Master Stockist Wan Zuraidal" },
        { id: 7, value: "Master Stockist Nazariah" },
        { id: 8, value: "Master Stockist Masdiana Mohamadia" },
        { id: 9, value: "Master Stockist Nurul Aini" },
        { id: 10, value: "Master Stockist Nur Shafiqah" },
        { id: 11, value: "Master Stockist Noraishah Isnin" }
      ],
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

  methods: {
    pickFile() {
      this.$refs.image.click();
    },

    onFilePicked(e) {
      const files = e.target.files;
      if (files[0] !== undefined) {
        this.imageName = files[0].name;
        if (this.imageName.lastIndexOf(".") <= 0) {
          return;
        }
        const fr = new FileReader();
        fr.readAsDataURL(files[0]);
        fr.addEventListener("load", () => {
          this.imageUrl = fr.result;
          this.imageFile = files[0]; // this is an image file that can be sent to server...
        });
      } else {
        this.imageName = "";
        this.imageFile = "";
        this.imageUrl = "";
      }
    },
    register() {
      var app = this;
      this.$auth.register({
        data: {
          name: app.name,
          // photo: app.imageFile,
          email: app.email,
          password: app.password,
          password_confirmation: app.password_confirmation,
          city: app.city,
          nric: app.nric,
          phone: app.phone,
          state: app.state,
          province: app.province,
          leader_name: app.leader_name,
          leader_phone: app.leader_phone,
          master_stockist: app.master_stockist
        },
        success: function() {
          app.success = true;
          this.$router.push({
            name: "login",
            params: { successRegistrationRedirect: true }
          });
        },
        error: function(res) {
          console.log(res.response.data.errors);
          app.has_error = true;
          app.error = res.response.data.error;
          app.errors = res.response.data.errors || {};
        }
      });
    }
  }
};
</script>
