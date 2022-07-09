import { Controller } from "@hotwired/stimulus";

export default class extends Controller{

    static values = {
        text: String,
        position: Number
    }

    static targets = ['btn'];

    initialize(){
        this.btnTarget.innerHTML = this.textValue;
    }

    handleScroll(){
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            this.btnTarget.classList.add('show');
        } else {
            this.btnTarget.classList.remove('show');
        }
    }

    handleClick(e){
        
        document.body.scrollTop = this.positionValue; // For Safari
        document.documentElement.scrollTop = this.positionValue; // For Chrome, Firefox, IE and Opera

    }

}