document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('dormitory').addEventListener('change', function() {
    
        var dormitoryID = this.value;
    
        var roomSelect = document.getElementById('room');
    
        roomSelect.disabled = dormitoryID === '';
    
        roomSelect.innerHTML = '';
    
        var endpoint = 'fetchAvailableRooms';
        var formData = new FormData();
    
        formData.append('dormitoryID', dormitoryID);
    
        if(dormitoryID !== '') {
            fetch(endpoint, {
                method: 'POST',
                body: formData,
                credentials: 'include'
            }).then(response => response.json()).then(data => {
                console.log(data);
                var rooms = data;

                roomSelect.innerHTML = '';
            
                rooms.forEach(room => {
                    var option = document.createElement('option');
                    option.value = room.RoomID;
                    option.text = room.Roomcode + ' | ' + room.Type + '-osobowy';
                    
                    roomSelect.appendChild(option);
                })
            }).catch((error) => {
                console.log(error);
            });
                
        }
    });
});