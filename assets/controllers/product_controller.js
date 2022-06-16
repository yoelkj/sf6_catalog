import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    showDeail(event) {

        event.preventDefault();
        
        console.log('Product controller clicked showDeail actions');
    }
}
