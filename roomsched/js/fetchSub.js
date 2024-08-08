document.addEventListener('DOMContentLoaded', () =>{
    const form = document.getElementById('selection-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();  // Prevent the default form submission

        const yr = document.getElementById('yr-container').value;
        const section = document.getElementById('section-container').value;

        // Fetch subjects based on selected year and section
        fetch(`subjectList.php?yr=${yr}&section=${section}`)  // Ensure this is the correct path to your subjects fetching PHP script
            .then(response => response.json())
            .then(subjects => {
                const draggableContainer = document.getElementById('draggable-container');
                draggableContainer.innerHTML = '';  // Clear previous subjects

                if (subjects.length > 0) {
                    subjects.forEach((subject, index) => {
                        const div = document.createElement('div');
                        div.className = 'draggable';
                        div.draggable = true;
                        div.id = 'subject' + (index + 1);
                        div.textContent = subject;
                        draggableContainer.appendChild(div);

                        // Add drag event listeners
                        div.addEventListener('dragstart', (e) => {
                            e.dataTransfer.setData('text/plain', div.id);
                        });
                    });

                    // Add drag and drop functionality
                    const droppableElements = document.querySelectorAll('.droppable');
                    droppableElements.forEach(droppable => {
                        droppable.addEventListener('dragover', (e) => {
                            e.preventDefault();
                        });
                        droppable.addEventListener('drop', (e) => {
                            e.preventDefault();
                            const draggableId = e.dataTransfer.getData('text/plain');
                            const draggableElement = document.getElementById(draggableId);
                            e.target.appendChild(draggableElement);
                        });
                    });
                } else {
                    const resultsDiv = document.getElementById('results');
                    resultsDiv.textContent = 'No subjects found for the selected year and section.';
                }
            })
            .catch(error => console.error('Error fetching subjects:', error));
    });
});