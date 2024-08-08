document.addEventListener('DOMContentLoaded', () => {
    const draggables = document.querySelectorAll('.draggable');
    const droppables = document.querySelectorAll('.droppable');

    draggables.forEach(draggable => {
        draggable.addEventListener('dragstart', (e) => {
            e.dataTransfer.setData('text/plain', e.target.id);
        });
    });

    droppables.forEach(droppable => {
        droppable.addEventListener('dragover', (e) => {
            e.preventDefault();
        });

        droppable.addEventListener('drop', (e) => {
            e.preventDefault();
            const data = e.dataTransfer.getData('text/plain');
            const draggable = document.getElementById(data);
            
            // Check if the droppable is already occupied
            if (droppable.children.length === 0) {
                if (draggable) {
                    e.target.innerHTML = ''; // Clear the drop target
                    e.target.appendChild(draggable);
                    droppable.classList.add('occupied'); // Add occupied class
                }
            } else {
                alert('This slot is already occupied!');
            }
        });

        droppable.addEventListener('dragleave', (e) => {
            e.target.style.backgroundColor = '#ffffff';
        });

        droppable.addEventListener('dragenter', (e) => {
            e.target.style.backgroundColor = '#ffffff';
        });
    });
});