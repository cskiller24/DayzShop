import * as bootstrap from "bootstrap";
import "@tabler/core"
import $ from 'jquery';
import {Livewire} from '../../vendor/livewire/livewire/dist/livewire.esm';
import axios from "axios";

import.meta.glob(["../images/**", "../fonts/**"]);

window.bootstrap = bootstrap;
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.$ = $;
Livewire.start();

// import "./toggle";
