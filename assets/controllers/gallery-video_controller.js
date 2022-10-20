import { Controller } from "@hotwired/stimulus";
import $ from 'jquery';

export default class extends Controller{
 
    static values = {
        url: String
    }

    static targets = ['preview'];


    async handleClick(evt){

        const currentTarget = evt.currentTarget;
        let code = currentTarget.getAttribute("code");

        let $preview = $(this.previewTarget);
        let data = {};
        data.code = code;

        try {
            await $.ajax({
                url: this.urlValue,
                method: 'POST',
                data: data,
                beforeSend: function(){
                    //$preview.html('');
                },
                success: function(data){
                    $preview.html(data)
                    $('.gallery-video .thumbs .item-thumb').removeClass('selected');
                    $(currentTarget).parent().addClass('selected');
                },
                complete: function(){
                }
            });
        } catch (e) {
            $preview.html();
        }

    }
    

}