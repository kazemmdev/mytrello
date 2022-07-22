import * as lodash from "lodash";
import axios from "axios";

window._ = lodash;

window.axios = axios;
window.axios.defaults.headers = {
    "Accept" : "application/json",
    "Content-Type": "application/json",
}
