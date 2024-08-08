document.getElementById('saveScheduleButton').addEventListener('click', saveSchedule);

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
            scheduleData.push({ subject, day, startTime, endTime, roomNumber: selectedRoomNumber });
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
