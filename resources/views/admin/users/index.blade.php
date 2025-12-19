@extends('admin.base')

@section('title')
Kullanıcılar
@endsection

@section('page-title')
Kullanıcılar
@endsection

@section('content')
<div class="users-page">
    <div class="page-header">
        <h1 class="title">Kullanıcılar</h1>
    </div>
    
    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ad Soyad</th>
                    <th>E-posta</th>
                    <th>Rol</th>
                    <th>Kayıt Tarihi</th>
                    <th>İşlemler</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->role === 'admin')
                            <span class="role-badge role-admin">Admin</span>
                        @else
                            <span class="role-badge role-user">Kullanıcı</span>
                        @endif
                    </td>
                    <td>{{ $user->created_at->format('d.m.Y H:i') }}</td>
                    <td>
                        <div class="action-buttons">
                            @if($user->role !== 'admin')
                                <form action="{{ route('admin.users.make-admin', $user) }}" method="POST" class="inline-form">
                                    @csrf
                                    <button type="submit" class="btn-action btn-admin" title="Admin Yap">
                                        <i class="fas fa-user-shield"></i>
                                    </button>
                                </form>
                            @else
                                @if($user->id !== auth()->id())
                                    <form action="{{ route('admin.users.remove-admin', $user) }}" method="POST" class="inline-form">
                                        @csrf
                                        <button type="submit" class="btn-action btn-remove-admin" title="Admin Yetkisini Kaldır">
                                            <i class="fas fa-user-minus"></i>
                                        </button>
                                    </form>
                                @endif
                            @endif
                            
                            @if($user->id !== auth()->id())
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline-form delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete" title="Sil" onclick="return confirm('Bu kullanıcıyı silmek istediğinize emin misiniz?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="empty-state">Henüz kullanıcı bulunmamaktadır.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        
        <div class="pagination-wrapper">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
