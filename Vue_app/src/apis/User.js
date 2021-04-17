import Api from "./Api";
// import Csrf from "./Csrf";

export default {
  // spa area
//   async register(form) {
//     await Csrf.getCookie();

//     return Api.post("/register", form);
//   },

// // for spa authentication
//   async login(form) {
//     await Csrf.getCookie();

//     return Api.post("/login", form);
//   },

//   async logout() {
//     await Csrf.getCookie();

//     return Api.post("/logout");
//   },

//   auth() {
//     return Api.get("/user");
//   }

  register(form) {
    return Api().post("/register", form);
  },

// for spa authentication
  login(form) {
    return Api().post("/login", form);
  },

  logout() {
    return Api().post("/logout");
  },

  auth() {
    return Api().get("/user");
  }
};