// $(document).ready(function(){
//     loadAllComments();
//     function loadAllComments(){
//         $.ajax({
//             type:"POST",
//             url:"code.php",
//             data:{
//                 'comment_load_data':true,

//             },
//             success:function(response){
//                 $(".comment_line").empty();
//                // console.log(response);
//                 let htmlElements = ``;
//                 $.each(response ,function (Key,value){
//                htmlElements += `
//                     <div class="back-ground-comment-part-one">
//                             <img class="imge-comment" src="../project-myserves/layot/img/${value.user['imgg']}" alt="">
//                             <span class="commnt-span"> ${value.user['name']}</span><i class="far fa-clock icon-commint-details"></i>
//                             <span class="span-commnt-data">${value.cmt['commented_on']}</span>
//                             <div class="commnt-text"> ${value.cmt['comment']}</div>
//                             <i class="fas fa-reply icon-commint-details-tow"></i>
//                             <span class="replay-commnt" data-id="${value.cmt['comment_id']}">0ردود</span>
//                             <small class="replay-feedback" data-id="${value.cmt['comment_id']}" style="margin-right:20px">رد على تعليق</small>\
//                             <div class="ml-4 replay_section"></div>
//                     </div>`;
//                 $(".comment_line").append(htmlElements);
//             });
//             }
//         });
//     }



    // $(document).on('click','.replay-feedback',function(){
    //     var thisClicked = $(this);
    //     var cmt_id = thisClicked;
    //     $('.replay_section').empty();
    //     let htmlReplayForm = `
    //         <input type="text" class="reply_msg form-control my-2" placholder="reply">
    //             <div class="text-end">
    //                 <button class="btn btn-sm btn-primary reply_add_btn">reply</button>
    //                 <button class="btn btn-sm btn-danger reply_cancel_btn">cancel</button>
    //             </div>
    //     `;

    //     thisClicked.siblings(".replay_section").html(htmlReplayForm);

    // });

//     $(document).on('click','.reply_cancel_btn', function(){

//         $('.replay_section').empty();

//     });
// });


// '<div class="back-ground-comment-part-one">\
//                 <img class="imge-comment" src="../project-myserves/layot/img/'+value.user['imgg']+'" alt=""><span class="commnt-span"> '+ value.user['name'] +' </span><i class="far fa-clock icon-commint-details"></i><span class="span-commnt-data">'+value.cmt['commented_on']+'</span>\
//                 <div class="commnt-text"> '+value.cmt['comment']+' </div>\
//                 <i class="fas fa-reply icon-commint-details-tow"></i><span class="replay-commnt" data-id="'+value.cmt['comment_id']+'">0ردود</span><small class="replay-feedback" data-id="'+value.cmt['comment_id']+'" style="margin-right:20px">رد على تعليق</small>\
//                 <div class="ml-4 replay_section"></div>\
//               </div>'







// load_comment();
// function load_comment(){
//     $.ajax({
//         type:"POST",
//         url:"code.php",
//         data:{
//             'comment_load_data':true

//         },
//         success:function(response){
//             $(".comment_line").html("");
//             console.log(response);
//             $.each(response ,function (Key,value){
           
//             $(".comment_line").
//             append('<div class="back-ground-comment-part-one">\
//             <img class="imge-comment" src="../project-myserves/layot/img/'+value.user['imgg']+'" alt=""><span class="commnt-span"> '+ value.user['name'] +' </span><i class="far fa-clock icon-commint-details"></i><span class="span-commnt-data">'+value.cmt['commented_on']+'</span>\
//             <div class="commnt-text"> '+value.cmt['comment']+' </div>\
//             <i class="fas fa-reply icon-commint-details-tow"></i><span class="replay-commnt" data-id="'+value.cmt['comment_id']+'">0ردود</span><small class="replay-feedback" data-id="'+value.cmt['comment_id']+'" style="margin-right:20px">رد على تعليق</small>\
//             <div class="ml-4 replay_section"></div>\
//           </div>');
//         });
//         }
//     });
// }