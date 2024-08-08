document.addEventListener('DOMContentLoaded', () => {
    // Attach click event listeners to buttons
    document.querySelectorAll('.room').forEach(button => {
        button.addEventListener('click', () => {
            const room = button.getAttribute('data-room');
            filterByRoom(room);
        });
    });
});

let selectedRoomNumber = null;
function filterByRoom(room) {
    selectedRoomNumber = room;
    console.log('Room selected:', selectedRoomNumber);
    fetch(`../php/displaySched.php?room=${room}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                displaySchedule(data.schedule);
                const roomHeader = document.getElementById('roomHeader');
                roomHeader.textContent = `Room: ${room}`;
            } else {
                console.error('Error fetching schedule:', data.message);
                alert('Error fetching schedule.');
            }
        })
        .catch(error => {
            console.error('Fetch error:', error);
            alert('Error fetching schedule.');
        });
}
function saveSchedule() {
    if (typeof selectedRoomNumber === 'undefined' || selectedRoomNumber === null) {
        alert('Please select a room number before saving.');
        return;
    }
    const scheduleData = [];
    document.querySelectorAll('.droppable').forEach(slot => {
        const slotId = slot.id;
        const subject = slot.textContent.trim(); // Assuming the subject name is in the text content
        if (subject) {
            const [day, startTime, endTime] = slotId.split('_');
            scheduleData.push({ subject, day, startTime, endTime, roomNumber });
        }
    });

    fetch('../php/saveSched.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(scheduleData),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
        } else {
            alert(data.message);
        }
    })
    .catch((error) => {
        console.error('Error:', error);
        alert('Error saving schedule.');
    });
}
function displaySchedule(schedule) {
    // Clear existing schedule
    const slots = document.querySelectorAll('.droppable');
    slots.forEach(slot => {
        slot.textContent = ''; // Clear slot content
    });

    // Populate the schedule
    schedule.forEach(entry => {
        const { subject, day, startTime, endTime } = entry;
        const slotId = `${day}_${startTime}_${endTime}`;
        const slotElement = document.getElementById(slotId);

        if (slotElement) {
            slotElement.textContent = subject;
        } else {
            console.warn(`No slot found with ID: ${slotId}`);
        }
    });
}

