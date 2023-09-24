$(document).ready(function(){
    $.ajax({
        url: 'server/hello.php',
        method: "GET",
        dataType: "html",
        success: function(data){
            console.log(data);

            let temp = '';
            for (let row of JSON.parse(data)) {
                temp += "<tr class='columns'> <td>" + row.x + "</td> <td>" +
                    row.y + "</td> <td>" + row.r + "</td> <td>" + row.status +
                    "</td> <td>" + row.current_time + "</td> <td>" + row.script_time + "</td> </tr>";
            }

            $("#results-body").html(temp);
        },
        error: function(error){
            console.log(error);
        },
    })
})


$("#user-input").on("submit", function(event){
    event.preventDefault();

    $.ajax({
        url: 'server/script.php',
        method: "GET",
        data: $(this).serialize() + "&timezone=" + new Date().getTimezoneOffset(),
        dataType: "html",

        success: function(data){
            data = JSON.parse(data)
            console.log(data);

            let temp = '';
            for (let row of data) {
                temp += "<tr class='columns'> <td>" + row.x + "</td> <td>" +
                    row.y + "</td> <td>" + row.r + "</td> <td>" + row.status +
                    "</td> <td>" + row.current_time + "</td> <td>" + row.script_time + "</td> </tr>";
            }

            let last = data.pop()
            draw(last.x, last.y, last.r)

            $("#results-body").html(temp);
        },
        error: function(error){
            console.log(error);
        },
    })
});

//
// $(".reset_button").on("click",function(){
//     $.ajax({
//         url: 'php/clear.php',
//         method: "POST",
//         dataType: "html",
//         success: function(data){
//             console.log(data);
//             $("#result_table>tbody").html(data);
//         },
//         error: function(error){
//             console.log(error);
//         },
//     })
// })