import * as bootstrap from "bootstrap";
import "@tabler/core"
import {Alpine, Livewire} from '../../vendor/livewire/livewire/dist/livewire.esm';
import axios from "axios";
import {mask} from "@alpinejs/mask";

import.meta.glob(["../images/**", "../fonts/**"]);

window.bootstrap = bootstrap;
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
Alpine.plugin(mask);
Livewire.start();

// import "./toggle";
