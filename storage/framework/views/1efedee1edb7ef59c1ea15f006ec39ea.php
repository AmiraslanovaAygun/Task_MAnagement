<?php $__env->startSection('customJs'); ?>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function showAlert(icon, text) {
            Swal.fire({
                icon: icon,
                text: text,
                showConfirmButton: true,
                confirmButtonText: "OK",
                timer: 6000
            });
        }

        
        document.addEventListener('DOMContentLoaded', function () {
            const startDate = document.getElementById('start_date');
            const endDate = document.getElementById('end_date');

            if (startDate && endDate) {
                function updateEndDateMin() {
                    endDate.min = startDate.value; // end_date-in minimum dəyərini start_date-ə uyğunlaşdırır
                    if (endDate.value < startDate.value) {
                        endDate.value = startDate.value;
                    }
                }

                startDate.addEventListener('change', updateEndDateMin);
            }
        });



        
        //NAME change
        function toggleEditProjectName(projectId) {
            document.getElementById(`projectNameText${projectId}`).classList.toggle('d-none');
            document.getElementById(`projectNameEdit${projectId}`).classList.toggle('d-none');
            document.getElementById(`saveProjectNameBtn${projectId}`).classList.toggle('d-none');
        }

        function saveProjectName(projectId) {
            let newName = document.getElementById(`projectNameEdit${projectId}`).value;
            document.getElementById(`projectNameText${projectId}`).textContent = newName;
            toggleEditProjectName(projectId);
        }

        //DESCRIPTION change

        function toggleEditDescription(projectId) {
            document.getElementById(`descriptionText${projectId}`).classList.toggle('d-none');
            document.getElementById(`descriptionEdit${projectId}`).classList.toggle('d-none');
            document.getElementById(`saveDescriptionBtn${projectId}`).classList.toggle('d-none');
        }

        function saveDescription(projectId) {
            let newDescription = document.getElementById(`descriptionEdit${projectId}`).value;
            document.getElementById(`descriptionText${projectId}`).textContent = newDescription;
            toggleEditDescription(projectId);
        }


        // DATES change
        function toggleEditStartDate(projectId) {
            document.getElementById(`startDateText${projectId}`).classList.toggle('d-none');
            document.getElementById(`startDateEdit${projectId}`).classList.toggle('d-none');
            document.getElementById(`saveStartDateBtn${projectId}`).classList.toggle('d-none');
        }

        function toggleEditEndDate(projectId) {
            document.getElementById(`endDateText${projectId}`).classList.toggle('d-none');
            document.getElementById(`endDateEdit${projectId}`).classList.toggle('d-none');
            document.getElementById(`saveEndDateBtn${projectId}`).classList.toggle('d-none');
        }

        function saveStartDate(projectId) {
            let newStartDate = document.getElementById(`startDateEdit${projectId}`).value;
            document.getElementById(`startDateText${projectId}`).innerText = newStartDate;
            toggleEditStartDate(projectId);
        }


        function saveEndDate(projectId) {
            let newEndDate = document.getElementById(`endDateEdit${projectId}`).value;
            document.getElementById(`endDateText${projectId}`).innerText = newEndDate;
            toggleEditEndDate(projectId);
        }


        function addTask(projectId) {
            let taskName = document.getElementById(`taskInput${projectId}`).value;
            if (taskName.trim() === '') return;

            let taskContainer = document.getElementById(`newTasksList${projectId}`);
            let newTasksSection = document.getElementById(`newTasksContainer${projectId}`);

            let newTaskDiv = document.createElement('div');
            newTaskDiv.classList.add('d-flex', 'justify-content-between', 'align-items-center', 'bg-light', 'p-2', 'my-1', 'rounded');

            newTaskDiv.innerHTML = `
        <input type="text" name="tasks[new][]" value="${taskName}" class="form-control w-75">
        <button type="button" class="btn btn-sm btn-outline-danger" onclick="this.parentElement.remove()">Sil</button>
    `;

            taskContainer.appendChild(newTaskDiv);
            newTasksSection.classList.remove('d-none'); // Yeni tasklar bölməsini göstər

            document.getElementById(`taskInput${projectId}`).value = '';
        }


        function deleteTask(buttonElement) {
            let taskDiv = buttonElement.closest('.current-task');
            if (taskDiv) {
                taskDiv.remove();
            }
        }

        function editTask(buttonElement) {
            let taskInput = buttonElement.closest('.d-flex').querySelector('input');
            let taskId = taskInput.dataset.taskId; // Task ID-ni götür

            if (taskInput.disabled) {
                taskInput.disabled = false;
                buttonElement.textContent = 'Yadda saxla';
                taskInput.focus();
            } else {
                buttonElement.textContent = 'Redaktə et';
                taskInput.setAttribute("name", "tasks[" + taskId + "]");
                taskInput.classList.add('edited-task');
                taskInput.disabled = true;
            }
        }

        document.addEventListener("DOMContentLoaded", function () {
            let form = document.querySelector("form"); // Formu tapırıq

            form.addEventListener("submit", function () {
                document.querySelectorAll("input[disabled]").forEach(input => {
                    input.disabled = false; // Submit olmamışdan əvvəl input-ları aktiv edirik
                });
            });
        });

        function toggleEditTask(taskId) {
            document.getElementById(`taskText${taskId}`).classList.toggle('d-none');
            document.getElementById(`taskInput${taskId}`).classList.toggle('d-none');
            document.getElementById(`editTaskBtn${taskId}`).classList.toggle('d-none');
            document.getElementById(`saveTaskBtn${taskId}`).classList.toggle('d-none');
            let inputField = document.getElementById(`taskInput${taskId}`);
            if (!inputField.classList.contains('d-none')) {
                inputField.focus();
            }
        }

        function saveTask(taskId) {
            let inputField = document.getElementById(`taskInput${taskId}`);
            let textField = document.getElementById(`taskText${taskId}`);
            textField.textContent = inputField.value;
            inputField.setAttribute("name", "tasks[" + taskId + "]");
            toggleEditTask(taskId);
        }


        // Modal bağlandıqda task siyahısını təmizlə
        document.addEventListener('DOMContentLoaded', function () {
            let modals = document.querySelectorAll('.modal');
            modals.forEach(modal => {
                modal.addEventListener('hidden.bs.modal', function () {
                    let taskLists = modal.querySelectorAll('[id^="tasksList"]');
                    taskLists.forEach(taskList => {
                        taskList.innerHTML = '';
                    });
                });
            });
        });

        document.addEventListener('hidden.bs.modal', function (event) {
            var modalId = event.target.id;
            if (modalId.startsWith('userModal')) {
                var projectModalId = 'projectModal' + modalId.replace('userModal', '');
                var projectModal = new bootstrap.Modal(document.getElementById(projectModalId));
                projectModal.show();
            }
        });


        document.addEventListener("DOMContentLoaded", function () {
            console.log("JS yükləndi");

            // İstifadəçilərin əsas forma ilə sinxronizasiyasını təmin etmək üçün
            // userModal bağlandıqda işləyən funksiya
            function syncUsersToMainForm(projectId) {
                // userModal-dan mövcud istifadəçiləri al
                let userInputs = document.querySelectorAll(`#current-users-${projectId} input[name="users[]"]`);
                let userIds = Array.from(userInputs).map(input => input.value);

                // Əsas formada varsa köhnə user input-larını təmizlə
                let mainForm = document.querySelector(`#projectModal${projectId} form`);
                let existingUserInputs = mainForm.querySelectorAll('input[name="users[]"]');
                existingUserInputs.forEach(input => {
                    if (!input.closest(`#current-users-${projectId}`)) {
                        input.remove();
                    }
                });

                // Əsas formaya gizli inputlar əlavə et
                let formContainer = document.createElement('div');
                formContainer.id = `hidden-users-${projectId}`;
                formContainer.style.display = 'none';

                // Əvvəlcə mövcud gizli user container-i təmizlə
                let existingContainer = mainForm.querySelector(`#hidden-users-${projectId}`);
                if (existingContainer) {
                    existingContainer.remove();
                }

                userIds.forEach(userId => {
                    let hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = 'users[]';
                    hiddenInput.value = userId;
                    formContainer.appendChild(hiddenInput);
                });

                mainForm.appendChild(formContainer);
            }

            // UserModal bağlandıqda işləsin
            document.querySelectorAll('.modal').forEach(modal => {
                modal.addEventListener('hidden.bs.modal', function (event) {
                    if (this.id.startsWith('userModal')) {
                        let projectId = this.id.replace('userModal', '');
                        syncUsersToMainForm(projectId);
                    }
                });
            });

            document.querySelectorAll(".add-user-btn").forEach(button => {
                button.addEventListener("click", function () {
                    let listItem = this.closest("li");
                    let userId = listItem.getAttribute("data-user-id");
                    let userName = listItem.getAttribute("data-user-name");
                    let userAvatar = listItem.getAttribute("data-user-avatar");
                    let projectId = listItem.closest("ul").id.replace("available-users-", "");

                    console.log("İstifadəçi əlavə olunur:", userId, "Proyekt:", projectId);

                    // Mövcud istifadəçilər siyahısına əlavə et
                    let currentUserList = document.getElementById(`current-users-${projectId}`);
                    let newListItem = document.createElement("li");
                    newListItem.classList.add("list-group-item", "d-flex", "align-items-center", "justify-content-between");
                    newListItem.setAttribute("data-user-id", userId);

                    let userHtml = `<div class="d-flex align-items-center">`;
                    if (userAvatar) {
                        userHtml += `<img src="${userAvatar}" class="rounded-circle me-2" width="30" height="30">`;
                    } else {
                        let initials = userName.split(" ").map(n => n[0].toUpperCase()).join("");
                        userHtml += `<div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center me-2"
                      style="width: 30px; height: 30px;">${initials}</div>`;
                    }
                    userHtml += `<span>${userName}</span></div>`;

                    newListItem.innerHTML = userHtml + `
                <button class="btn btn-sm btn-danger remove-user-btn">Sil</button>
                <input type="hidden" name="users[]" value="${userId}">
            `;

                    currentUserList.appendChild(newListItem);
                    listItem.remove(); // Əlavə edilən user-i "mövcud olmayan" siyahıdan çıxar

                    // Project Modal-a user avatar əlavə et
                    addUserToMainModal(projectId, userId, userName, userAvatar);

                    // İstifadəçi dəyişikliklərini əsas formaya sinxronlaşdır
                    syncUsersToMainForm(projectId);

                    addRemoveUserEvent(); // Yeni yaradılmış düyməyə remove event əlavə et
                });
            });

            function addRemoveUserEvent() {
                document.querySelectorAll(".remove-user-btn").forEach(button => {
                    button.onclick = function () {
                        let userItem = this.closest("li");
                        let userId = userItem.getAttribute("data-user-id");
                        let projectId = userItem.closest("ul").id.replace("current-users-", "");
                        let userName = userItem.querySelector("span").textContent.trim();
                        let userAvatar = userItem.querySelector("img") ? userItem.querySelector("img").src : '';

                        console.log("İstifadəçi silinir:", userId, "Proyekt:", projectId);

                        let availableUsersList = document.getElementById(`available-users-${projectId}`);
                        let newListItem = document.createElement("li");
                        newListItem.classList.add("list-group-item", "d-flex", "justify-content-between", "align-items-center");
                        newListItem.setAttribute("data-user-id", userId);
                        newListItem.setAttribute("data-user-name", userName);
                        newListItem.setAttribute("data-user-avatar", userAvatar);

                        newListItem.innerHTML = `${userName}
                    <button class="btn btn-sm btn-primary add-user-btn">Əlavə et</button>`;

                        availableUsersList.appendChild(newListItem);
                        userItem.remove(); // Mövcud istifadəçilər siyahısından çıxar

                        removeUserFromMainModal(projectId, userId);

                        // İstifadəçi dəyişikliklərini əsas formaya sinxronlaşdır
                        syncUsersToMainForm(projectId);

                        // Yeni "Əlavə et" düyməsinə event listener əlavə et
                        newListItem.querySelector(".add-user-btn").addEventListener("click", function () {
                            let listItem = this.closest("li");
                            let userId = listItem.getAttribute("data-user-id");
                            let userName = listItem.getAttribute("data-user-name");
                            let userAvatar = listItem.getAttribute("data-user-avatar");
                            let projectId = listItem.closest("ul").id.replace("available-users-", "");

                            // Mövcud istifadəçilər siyahısına əlavə et
                            let currentUserList = document.getElementById(`current-users-${projectId}`);
                            let newListItem = document.createElement("li");
                            newListItem.classList.add("list-group-item", "d-flex", "align-items-center", "justify-content-between");
                            newListItem.setAttribute("data-user-id", userId);

                            let userHtml = `<div class="d-flex align-items-center">`;
                            if (userAvatar) {
                                userHtml += `<img src="${userAvatar}" class="rounded-circle me-2" width="30" height="30">`;
                            } else {
                                let initials = userName.split(" ").map(n => n[0].toUpperCase()).join("");
                                userHtml += `<div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center me-2"
                              style="width: 30px; height: 30px;">${initials}</div>`;
                            }
                            userHtml += `<span>${userName}</span></div>`;

                            newListItem.innerHTML = userHtml + `
                        <button class="btn btn-sm btn-danger remove-user-btn">Sil</button>
                        <input type="hidden" name="users[]" value="${userId}">
                    `;

                            currentUserList.appendChild(newListItem);
                            listItem.remove(); // Əlavə edilən user-i "mövcud olmayan" siyahıdan çıxar

                            // Project Modal-a user avatar əlavə et
                            addUserToMainModal(projectId, userId, userName, userAvatar);

                            // İstifadəçi dəyişikliklərini əsas formaya sinxronlaşdır
                            syncUsersToMainForm(projectId);

                            addRemoveUserEvent(); // Yeni yaradılmış düyməyə remove event əlavə et
                        });
                    };
                });
            }

            function addUserToMainModal(projectId, userId, userName, userAvatar) {
                let userList = document.getElementById(`project-users-${projectId}`);
                if (!userList) return;

                let plusButton = userList.querySelector(".plus-btn");

                if (userList.querySelector(`[data-user-id="${userId}"]`)) {
                    return;
                }

                let userElement;
                if (userAvatar) {
                    userElement = document.createElement("img");
                    userElement.src = userAvatar;
                    userElement.classList.add("rounded-circle", "me-1", "project-user-avatar");
                    userElement.width = 40;
                    userElement.height = 40;
                } else {
                    userElement = document.createElement("div");
                    userElement.classList.add("rounded-circle", "bg-secondary", "text-white", "d-flex", "align-items-center", "justify-content-center", "me-1", "project-user-avatar");
                    userElement.style.width = "40px";
                    userElement.style.height = "40px";

                    // Ad və soyadın baş hərflərini götürmək
                    let initials = userName.split(" ").map(n => n[0].toUpperCase()).join("");
                    userElement.textContent = initials;
                }

                userElement.setAttribute("data-user-id", userId);
                userElement.style.marginLeft = "-12px";

                // **Avatarı `+` düyməsinin sağında yerləşdir**
                plusButton.parentNode.insertBefore(userElement, plusButton.nextSibling);
            }

            function removeUserFromMainModal(projectId, userId) {
                let userElement = document.querySelector(`#project-users-${projectId} [data-user-id="${userId}"]`);
                if (userElement) {
                    userElement.remove();
                }
            }

            addRemoveUserEvent(); // İlk dəfə yüklənəndə işləsin
        });

        
        $(document).ready(function () {
            $('.delete-button').on('click', function () {
                let id = $(this).data('id');
                let url = $(this).data('url');
                let element = $(this).closest('.current-task');

                Swal.fire({
                    title: 'Əminsiniz?',
                    text: "Bu əməliyyat geri qaytarıla bilməz!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Bəli, sil!',
                    cancelButtonText: 'Xeyr, ləğv et'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            type: "POST",
                            data: {
                                _method: 'DELETE',
                                _token: "<?php echo e(csrf_token()); ?>"
                            },
                            success: function (response) {
                                Swal.fire(
                                    'Silindi!',
                                    'Silinmə müvəffəqiyyətlə yerinə yetirildi',
                                    'success'
                                );

                                if (element.length > 0) {
                                    element.remove();
                                }
                                // Digər elementlər üçün əvvəlki kod işləsin
                                else if ($('button[data-id="' + id + '"]').closest('.col-12').length > 0) {
                                    $('button[data-id="' + id + '"]').closest('.col-12').remove();
                                } else if ($('button[data-id="' + id + '"]').closest('tr').length > 0) {
                                    $('button[data-id="' + id + '"]').closest('tr').remove();
                                }
                            },
                            error: function (xhr) {
                                var errors = xhr.responseJSON;
                                Swal.fire(
                                    'Xəta!',
                                    errors.message || 'Silinmə zamanı xəta baş verdi',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
        });


    </script>
<?php $__env->stopSection(); ?>
<?php /**PATH C:\Users\aygun\PhpstormProjects\TrelloApp\resources\views/components/admin/projectAlerts.blade.php ENDPATH**/ ?>