import 'owl.carousel/dist/assets/owl.carousel.css';
import 'owl.carousel/dist/assets/owl.theme.default.css';
import { Controller } from "@hotwired/stimulus";

import $ from 'jquery';
import 'owl.carousel';

export default class extends Controller{


    static values = {
        targetId: String
    }

    connect(){

        var obj_params = {
            margin:20,
            nav:false,
            items: 1,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items: 2
                },
                1000:{
                    items: 2
                }
            }
        };  

        $(this.targetIdValue).owlCarousel(obj_params);
    
    }
}