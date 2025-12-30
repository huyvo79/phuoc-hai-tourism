<div class="flex justify-center gap-2">
   {{-- Nút Sửa --}}
   <button class="edit-btn btn btn-sm btn-outline-primary" 
           data-toggle="modal" 
           data-target="#editUserModal"
           data-id="{{ $row->id }}" 
           data-username="{{ $row->username }}"
           data-name="{{ $row->name }}"
           title="Chỉnh sửa">
       <i class="fa-regular fa-pen-to-square"></i>
   </button>

   {{-- Nút Xóa --}}
   <button class="delete-btn btn btn-sm btn-outline-danger ml-2" 
           onclick="confirmDeleteUser({{ $row->id }})"
           title="Xóa">
       <i class="fa-solid fa-trash"></i>
   </button>
</div>