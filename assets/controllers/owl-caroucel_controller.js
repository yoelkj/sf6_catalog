import 'owl.carousel/dist/assets/owl.carousel.css';
import 'owl.carousel/dist/assets/owl.theme.default.css';
import { Controller } from "@hotwired/stimulus";

import $ from 'jquery';
import 'owl.carousel';

export default class extends Controller{

    connect(){
        
        console.log('Load owl caroucel');

        $('#owlCaroucel').owlCarousel({
            loop:true,
            margin:10,
            nav:true,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:3
                },
                1000:{
                    items:5
                }
            }
        })
    }
}