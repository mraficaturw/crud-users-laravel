# CRUD Users - Laravel Livewire SPA

<div align="center">
  <table>
    <tr>
      <td align="center" width="250" style="border: none;">
        <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="100%" alt="Laravel Logo">
      </td>
      <td align="center" width="50" style="border: none;">
        <span style="font-size: 30px;">+</span>
      </td>
      <td align="center" width="150" style="border: none;">
        <img src="https://laravel-livewire.com/img/logo.svg" width="100%" alt="Livewire Logo">
      </td>
    </tr>
  </table>
  
  <h3>Laravel 11 + Livewire 3</h3>
  <p><em>Full-stack development tanpa menulis JavaScript</em></p>
</div>

---

Aplikasi **User Management System** yang dibangun dengan Laravel 11 dan Livewire 3, menerapkan arsitektur Single Page Application (SPA) dengan fokus pada performa, efisiensi, dan keterbacaan kode.

---

## ⚡ Fokus Pembelajaran: Livewire

> **Livewire** adalah framework full-stack untuk Laravel yang membuat pengembangan antarmuka dinamis menjadi sederhana, tanpa perlu menulis JavaScript secara langsung.

### Mengapa Livewire?

| Keunggulan | Penjelasan |
|------------|------------|
| � **No JavaScript Required** | Interaktivitas penuh menggunakan PHP saja |
| 🔄 **Real-time Updates** | Komponen update otomatis tanpa page refresh |
| 📦 **Component-based** | Arsitektur komponen yang reusable |
| 🎯 **Laravel Native** | Terintegrasi sempurna dengan ekosistem Laravel |
| ⚡ **SPA Experience** | Navigasi cepat seperti Single Page Application |

### Konsep Livewire yang Dipelajari

```php
// 1. Two-way Data Binding
<input wire:model="search">  // Otomatis sync dengan property PHP

// 2. Real-time Search dengan Debounce
wire:model.live.debounce.100ms="search"  // Update setiap 100ms

// 3. Event Dispatching antar Component
$this->dispatch('confirm-delete', userId: $id);  // Kirim event
#[On('confirm-delete')]                           // Terima event
public function openModal(int $userId) { }

// 4. Livewire Attributes (Modern Syntax)
#[Validate('required|email')]  // Validasi declarative
#[On('user-deleted')]          // Event listener
#[Layout('layouts.app')]       // Full-page component layout

// 5. File Uploads dengan Preview
use WithFileUploads;
$avatar->temporaryUrl();  // Preview sebelum upload

// 6. Pagination Terintegrasi
use WithPagination;
$users->links('livewire.pagination');  // Custom pagination view
```

---

## �📚 Dokumentasi Pembelajaran

### Perjalanan Project Ini

Project ini dimulai sebagai pembelajaran dasar Laravel Livewire untuk operasi CRUD sederhana, kemudian berkembang menjadi aplikasi yang dioptimalkan dengan arsitektur yang lebih baik.

---

## 🎯 Fitur Utama

| Fitur | Deskripsi |
|-------|-----------|
| **CRUD Users** | Create, Read, Update, Delete operasi lengkap |
| **Search & Filter** | Real-time search dengan debounce |
| **Sortable Columns** | Klik header untuk sort ascending/descending |
| **Bulk Operations** | Select multiple users untuk bulk delete |
| **Avatar Upload** | Upload gambar dengan konversi WebP otomatis |
| **Modal Forms** | Edit & Delete confirmation dalam modal |
| **Profile View** | Lihat detail user dalam modal |
| **Pagination** | Navigasi halaman yang responsif |
| **Flash Messages** | Notifikasi sukses/error yang auto-dismiss |

---

## 🏗️ Arsitektur & Teknologi

### Tech Stack

| Technology | Version | Purpose |
|------------|---------|---------|
| **Laravel** | 11.x | PHP Framework |
| **Livewire** | 3.x | Full-stack SPA tanpa JavaScript |
| **Alpine.js** | 3.x | Reactive micro-interactions |
| **Tailwind CSS** | 4.x | Utility-first styling |
| **Vite** | 6.x | Asset bundling |

### Struktur Komponen

```
app/Livewire/
├── Users.php           # Main listing (full-page component)
├── Form.php            # Create user form (full-page component)
├── Confirmation.php    # Delete confirmation modal
├── EditModal.php       # Edit user modal
└── Profile.php         # View profile modal

resources/views/components/
├── modal.blade.php      # Reusable modal wrapper
├── alert.blade.php      # Flash message alerts
├── form-input.blade.php # Reusable input with error styling
└── layouts/
    └── app.blade.php    # Main layout
```

---

## 📖 Yang Saya Pelajari

### 1. Livewire Full-Page Components

**Sebelum:** Menggunakan route yang mengembalikan view biasa dengan `@livewire()` directive.

```php
// ❌ Sebelum
Route::get('/users', function () {
    return view('users'); // View terpisah dengan @livewire('users')
});
```

**Sesudah:** Menggunakan Livewire sebagai full-page component dengan `#[Layout]` attribute.

```php
// ✅ Sesudah
Route::get('/users', App\Livewire\Users::class);

// Di component:
#[Layout('components.layouts.app')]
class Users extends Component { }
```

**Keuntungan:**

- Lebih sedikit file (tidak perlu view wrapper)
- SPA-like navigation dengan `wire:navigate`
- Component lifecycle yang lebih kuat

---

### 2. Modern Livewire Attributes

**Sebelum:** Menggunakan `$listeners` array untuk event handling.

```php
// ❌ Cara lama
protected $listeners = ['confirm-delete' => 'openModal'];
```

**Sesudah:** Menggunakan `#[On]` attribute (lebih explicit dan IDE-friendly).

```php
// ✅ Cara baru
#[On('confirm-delete')]
public function openModal(int $userId): void { }
```

---

### 3. Reusable Blade Components

**Problem:** Duplikasi kode modal wrapper ~30 baris di 4 tempat berbeda.

**Solution:** Ekstrak ke Blade component yang reusable.

```blade
{{-- Sebelum: 30+ baris per modal --}}
<div x-data="{ show: @entangle('isOpen') }" 
     x-show="show"
     x-transition:enter="..." 
     x-transition:leave="..."
     ...>
    <!-- 20+ baris backdrop & centering code -->
</div>

{{-- Sesudah: 1 baris --}}
<x-modal name="delete-modal" max-width="xl">
    <!-- Hanya konten modal -->
</x-modal>
```

**Hasil:**

- Kode lebih DRY (Don't Repeat Yourself)
- Perubahan di satu tempat berlaku untuk semua modal
- Konsistensi animasi dan styling

---

### 4. Component Organization

**Yang Saya Pelajari:**

- **Session component dihapus** → Hanya berisi view tanpa logic, diubah ke Blade component
- **File duplikat dihapus** → `users.blade.php` dan `form.blade.php` tidak diperlukan dengan full-page components
- **Unused imports dibersihkan** → `use App\Livewire\Users;` di routes tidak digunakan

---

### 5. Type Hints & Documentation

**Praktik Baik yang Diterapkan:**

```php
// Property type hints
public bool $isOpen = false;
public ?int $userId = null;
public ?string $userName = null;

// Method return types
public function openModal(int $userId): void { }

// PHPDoc untuk context
/**
 * Delete the user and redirect with flash message
 */
public function delete(): void { }
```

---

## 📁 Perubahan yang Dilakukan

### Files Created (New)

| File | Purpose |
|------|---------|
| `components/modal.blade.php` | Reusable modal wrapper component |
| `components/alert.blade.php` | Flash message component |
| `components/form-input.blade.php` | Form input with error styling |

### Files Modified

| File | Changes |
|------|---------|
| `Users.php` | Added `#[Layout]`, `#[On]`, PHPDoc |
| `Form.php` | Added `#[Layout]`, extracted avatar processing |
| `Confirmation.php` | Added `#[On]`, type hints |
| `EditModal.php` | Added `#[On]`, early returns |
| `Profile.php` | Added `#[On]`, type hints |
| `web.php` | Full-page component routes |
| `app.blade.php` | Added alert component |
| `confirmation.blade.php` | Using x-modal component |
| `profile.blade.php` | Using x-modal component |
| `edit-modal.blade.php` | Using x-modal component |
| `users.blade.php` | Using x-modal for bulk delete |
| `form.blade.php` | Using x-form-input, wire:navigate |

### Files Deleted (Cleanup)

| File | Reason |
|------|--------|
| `views/users.blade.php` | Not needed with full-page components |
| `views/form.blade.php` | Not needed with full-page components |
| `Session.php` | No PHP logic, converted to Blade component |
| `session.blade.php` | Replaced by alert.blade.php |

---

## 🚀 Menjalankan Project

### Prerequisites

- PHP 8.2+
- Composer
- Node.js & NPM
- MySQL/PostgreSQL

### Installation

```bash
# Clone repository
git clone <repository-url>
cd crud-users

# Install dependencies
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Setup database
php artisan migrate
php artisan db:seed

# Create storage link untuk avatar
php artisan storage:link

# Run development server
npm run dev
php artisan serve
```

### Access

- **User Management:** <http://localhost:8000/users> (Form + Table berdampingan)

---

## 🧪 Testing

```bash
# Run all tests
php artisan test

# Run with coverage
php artisan test --coverage
```

---

## 📊 Metrics Improvement

| Metric | Before | After |
|--------|--------|-------|
| Total Files | ~20 | ~16 |
| Reusable Components | 0 | 3 |
| Duplicate Modal Code | ~120 lines × 4 | Shared component |
| Type Hints | Partial | Complete |
| PHPDoc Comments | Minimal | Comprehensive |

---

## 📝 Key Takeaways

1. **DRY Principle** - Identifikasi pola yang berulang dan ekstrak ke komponen reusable
2. **Modern Syntax** - Gunakan attributes (`#[On]`, `#[Layout]`) daripada array properties
3. **Type Safety** - Tambahkan type hints untuk mencegah bug dan meningkatkan IDE support
4. **Documentation** - PHPDoc membantu maintainability dan onboarding developer baru
5. **Full-Page Components** - Kurangi boilerplate dengan Livewire full-page components
6. **Clean Code** - Hapus file dan import yang tidak terpakai

---

## 📜 License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
