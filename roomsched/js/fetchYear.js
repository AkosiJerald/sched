document.addEventListener('DOMContentLoaded', () => {
    fetch('../php/yrSection.php')  // Replace with the path to your PHP script
        .then(response => response.json())
        .then(data => {
            // Debugging: Log the entire fetched data to the console
            console.log('Fetched Data:', data);

            const yrContainer = document.getElementById('yr-container');
            const sectionContainer = document.getElementById('section-container');

            // Populate the year dropdown
            Object.keys(data).forEach(yr => {
                console.log('Processing year:', yr); // Debugging: Log each year being processed

                const option = document.createElement('option');
                option.value = yr;
                option.textContent = yr;
                yrContainer.appendChild(option);
            });

            // Update the sections dropdown based on the selected year
            yrContainer.addEventListener('change', (event) => {
                const selectedYr = event.target.value;
                console.log('Selected year:', selectedYr); // Debugging: Log the selected year

                sectionContainer.innerHTML = '<option value="">Section</option>';  // Reset the sections dropdown

                if (data[selectedYr] && Array.isArray(data[selectedYr])) {
                    console.log('Sections for selected year:', data[selectedYr]); // Debugging: Log sections for the selected year

                    data[selectedYr].forEach(section => {
                        const option = document.createElement('option');
                        option.value = section;
                        option.textContent = section;
                        sectionContainer.appendChild(option);
                    });
                } else {
                    console.log('No sections found for selected year:', selectedYr); // Debugging: Log if no sections are found
                }
            });
        })
        .catch(error => console.error('Error fetching data:', error));
});
