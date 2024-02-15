import { Modal } from 'flowbite';

export const newModal = function (elementId, options=null) {
    const $modalElement = document.getElementById(elementId);
 
    // const modalOptions = {
    //     placement: 'bottom-right',
    //     backdrop: 'dynamic',
    //     backdropClasses: 'bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-40',
    //     onHide: () => {
    //         console.log('modal is hidden');
    //     },
    //     onShow: () => {
    //         console.log('modal is shown');
    //     },
    //     onToggle: () => {
    //         console.log('modal has been toggled');
    //     }
    // }
    
    const modal = new Modal($modalElement);

    function showModal() {
        modal.show()
    }

    function closeModal() {
        modal.hide()
    }

    return {
        showModal,
        closeModal
    }
}
