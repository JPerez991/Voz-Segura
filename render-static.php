<?php
require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Use relative URLs for generated HTML (no localhost prefix)
app(\Illuminate\Foundation\Vite::class)->createAssetPathsUsing(function ($path, $secure = null) {
    return '/' . ltrim($path, '/');
});

// Use SQLite in-memory database
Illuminate\Support\Facades\Config::set('database.default', 'sqlite');
Illuminate\Support\Facades\Config::set('database.connections.sqlite.database', ':memory:');
Illuminate\Support\Facades\DB::reconnect();

Illuminate\Support\Facades\DB::statement('PRAGMA foreign_keys = ON');

// Create tables
Illuminate\Support\Facades\DB::statement("CREATE TABLE users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nombre_usuario TEXT NOT NULL UNIQUE,
    email TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL,
    rol TEXT NOT NULL DEFAULT 'user',
    es_anonimo INTEGER NOT NULL DEFAULT 0,
    remember_token TEXT DEFAULT NULL,
    created_at TEXT DEFAULT NULL,
    updated_at TEXT DEFAULT NULL
)");

Illuminate\Support\Facades\DB::statement("CREATE TABLE profiles (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER NOT NULL UNIQUE,
    nombre_completo TEXT DEFAULT NULL,
    descripcion TEXT DEFAULT NULL,
    nombre_anonimo TEXT DEFAULT NULL,
    created_at TEXT DEFAULT NULL,
    updated_at TEXT DEFAULT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
)");

Illuminate\Support\Facades\DB::statement("CREATE TABLE forums (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    tema TEXT NOT NULL,
    descripcion TEXT NOT NULL,
    creado_por INTEGER NOT NULL,
    created_at TEXT DEFAULT NULL,
    updated_at TEXT DEFAULT NULL,
    FOREIGN KEY (creado_por) REFERENCES users(id) ON DELETE CASCADE
)");

Illuminate\Support\Facades\DB::statement("CREATE TABLE forum_replies (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    forum_id INTEGER NOT NULL,
    user_id INTEGER NOT NULL,
    responder TEXT NOT NULL,
    es_anonimo INTEGER NOT NULL DEFAULT 0,
    created_at TEXT DEFAULT NULL,
    updated_at TEXT DEFAULT NULL,
    FOREIGN KEY (forum_id) REFERENCES forums(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
)");

Illuminate\Support\Facades\DB::statement("CREATE TABLE sessions (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    psicologa_id INTEGER NOT NULL,
    usuario_id INTEGER NOT NULL,
    tipo_sesion TEXT NOT NULL,
    descripcion TEXT DEFAULT NULL,
    fecha_hora TEXT NOT NULL,
    completada INTEGER NOT NULL DEFAULT 0,
    created_at TEXT DEFAULT NULL,
    updated_at TEXT DEFAULT NULL,
    FOREIGN KEY (psicologa_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (usuario_id) REFERENCES users(id) ON DELETE CASCADE
)");

Illuminate\Support\Facades\DB::statement("CREATE TABLE messages (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    envia_id INTEGER NOT NULL,
    recibe_id INTEGER NOT NULL,
    mensaje TEXT NOT NULL,
    es_anonimo INTEGER NOT NULL DEFAULT 0,
    created_at TEXT DEFAULT NULL,
    updated_at TEXT DEFAULT NULL,
    FOREIGN KEY (envia_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (recibe_id) REFERENCES users(id) ON DELETE CASCADE
)");

Illuminate\Support\Facades\DB::statement("CREATE TABLE reports (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    session_id INTEGER NOT NULL,
    generated_by INTEGER NOT NULL,
    content TEXT NOT NULL,
    created_at TEXT DEFAULT NULL,
    updated_at TEXT DEFAULT NULL,
    FOREIGN KEY (session_id) REFERENCES sessions(id) ON DELETE CASCADE,
    FOREIGN KEY (generated_by) REFERENCES users(id) ON DELETE CASCADE
)");

// Seed data
$now = now();
Illuminate\Support\Facades\DB::table('users')->insert([
    ['id' => 1, 'nombre_usuario' => 'Maria_G', 'email' => 'maria@ejemplo.com', 'password' => bcrypt('password'), 'rol' => 'usuaria', 'es_anonimo' => 0, 'created_at' => $now, 'updated_at' => $now],
    ['id' => 2, 'nombre_usuario' => 'Lic_Carmen', 'email' => 'carmen@psicologa.com', 'password' => bcrypt('password'), 'rol' => 'psicologa', 'es_anonimo' => 0, 'created_at' => $now, 'updated_at' => $now],
    ['id' => 3, 'nombre_usuario' => 'Ana_98', 'email' => 'ana@ejemplo.com', 'password' => bcrypt('password'), 'rol' => 'usuaria', 'es_anonimo' => 0, 'created_at' => $now, 'updated_at' => $now],
]);

Illuminate\Support\Facades\DB::table('profiles')->insert([
    ['user_id' => 1, 'nombre_completo' => 'Maria García López', 'descripcion' => 'Soy una mujer de 28 años en busca de apoyo emocional. Me gusta la lectura y la jardinería.', 'nombre_anonimo' => 'Mariposa', 'created_at' => $now, 'updated_at' => $now],
    ['user_id' => 2, 'nombre_completo' => 'Dra. Carmen Martínez', 'descripcion' => 'Psicóloga clínica con más de 10 años de experiencia especializada en terapia de apoyo y acompañamiento.', 'nombre_anonimo' => null, 'created_at' => $now, 'updated_at' => $now],
    ['user_id' => 3, 'nombre_completo' => 'Ana Rodríguez Pérez', 'descripcion' => 'Madre de dos hijos, buscando un espacio seguro para compartir experiencias.', 'nombre_anonimo' => 'Estrella', 'created_at' => $now, 'updated_at' => $now],
]);

Illuminate\Support\Facades\DB::table('forums')->insert([
    ['id' => 1, 'tema' => 'Estrategias de afrontamiento', 'descripcion' => 'Compartamos técnicas y herramientas que nos ayudan a manejar el estrés y la ansiedad en nuestro día a día.', 'creado_por' => 2, 'created_at' => $now, 'updated_at' => $now],
    ['id' => 2, 'tema' => 'Experiencias de empoderamiento', 'descripcion' => 'Espacio para contar historias de superación personal y celebrar nuestros logros, grandes o pequeños.', 'creado_por' => 1, 'created_at' => $now, 'updated_at' => $now],
]);

Illuminate\Support\Facades\DB::table('forum_replies')->insert([
    ['forum_id' => 1, 'user_id' => 1, 'responder' => 'A mí me ha funcionado mucho la respiración profunda y salir a caminar cuando siento que la ansiedad me embarga. ¿A alguien más le sirve?', 'es_anonimo' => 0, 'created_at' => $now, 'updated_at' => $now],
    ['forum_id' => 1, 'user_id' => 3, 'responder' => 'Gracias por compartir. Yo practico mindfulness cada mañana y me ha cambiado la vida.', 'es_anonimo' => 1, 'created_at' => $now, 'updated_at' => $now],
    ['forum_id' => 2, 'user_id' => 2, 'responder' => 'Después de mucho trabajo personal, finalmente pude establecer límites saludables en mi vida. ¡Sí se puede!', 'es_anonimo' => 0, 'created_at' => $now, 'updated_at' => $now],
]);

Illuminate\Support\Facades\DB::table('sessions')->insert([
    ['psicologa_id' => 2, 'usuario_id' => 1, 'tipo_sesion' => 'Terapia individual', 'descripcion' => 'Sesión de seguimiento semanal para trabajar técnicas de relajación.', 'fecha_hora' => $now->copy()->addDays(2), 'completada' => 0, 'created_at' => $now, 'updated_at' => $now],
    ['psicologa_id' => 2, 'usuario_id' => 3, 'tipo_sesion' => 'Sesión de pareja', 'descripcion' => 'Primera sesión de orientación para mejorar la comunicación.', 'fecha_hora' => $now->copy()->addDays(5), 'completada' => 0, 'created_at' => $now, 'updated_at' => $now],
]);

Illuminate\Support\Facades\DB::table('messages')->insert([
    ['envia_id' => 2, 'recibe_id' => 1, 'mensaje' => 'Hola Maria, te recuerdo que tenemos sesión el jueves a las 4pm. ¡Te espero!', 'es_anonimo' => 0, 'created_at' => $now->copy()->subHours(2), 'updated_at' => $now->copy()->subHours(2)],
    ['envia_id' => 1, 'recibe_id' => 2, 'mensaje' => 'Gracias Carmen, confirmo asistencia. Estuve practicando los ejercicios de respiración y me han ayudado mucho.', 'es_anonimo' => 0, 'created_at' => $now->copy()->subHour(), 'updated_at' => $now->copy()->subHour()],
    ['envia_id' => 2, 'recibe_id' => 1, 'mensaje' => 'Me alegra mucho escuchar eso! La práctica constante es clave. Podemos revisar tu progreso el jueves.', 'es_anonimo' => 0, 'created_at' => $now, 'updated_at' => $now],
]);

Illuminate\Support\Facades\DB::table('reports')->insert([
    ['session_id' => 1, 'generated_by' => 2, 'content' => 'La paciente muestra una mejoría significativa. Continúa con las técnicas de respiración.', 'created_at' => $now->copy()->subDays(7), 'updated_at' => $now->copy()->subDays(7)],
]);

// Authenticate as Maria_G
$user = App\Models\User::find(1);
Illuminate\Support\Facades\Auth::login($user);

// Share $errors with all views
$errors = new Illuminate\Support\ViewErrorBag();
Illuminate\Support\Facades\View::share('errors', $errors);
Illuminate\Support\Facades\View::share('auth', null);

function renderView(string $file, string $view, array $data = []): void
{
    $html = Illuminate\Support\Facades\View::make($view, $data)->render();
    // Replace absolute localhost URLs with relative paths (static hosting)
    $html = str_replace('http://localhost:8000', '', $html);
    $path = __DIR__ . '/public/' . $file . '.html';
    @mkdir(dirname($path), 0777, true);
    file_put_contents($path, $html);
    echo "✓ Generated: public/{$file}.html\n";
}

// === RENDER VIEWS ===

// Public pages
renderView('index', 'welcome2');
renderView('login', 'auth.login');
renderView('register', 'auth.register');

// Dashboard
$profile = App\Models\Profile::where('user_id', $user->id)->first();
renderView('dashboard', 'dashboard', ['profile' => $profile]);

// Forums
$foros = App\Models\Forums::with('user')->get();
renderView('forums', 'forums.index', ['foros' => $foros]);

// Forum show (1)
$foro1 = App\Models\Forums::with(['user', 'replies.user'])->find(1);
if ($foro1) renderView('forums/1', 'forums.show', ['foro' => $foro1]);

// Forum show (2)
$foro2 = App\Models\Forums::with(['user', 'replies.user'])->find(2);
if ($foro2) renderView('forums/2', 'forums.show', ['foro' => $foro2]);

// Forum create
renderView('forums/create', 'forums.create');

// Sessions
$sessions = App\Models\Sessions::with(['psicologa', 'usuario'])->get();
renderView('sessions', 'sessions.index', ['sessions' => $sessions]);

// Sessions create
$psicologas = App\Models\User::where('rol', 'psicologa')->get();
$usuarios = App\Models\User::where('rol', 'usuaria')->get();
renderView('sessions/create', 'sessions.create', [
    'psicologas' => $psicologas,
    'usuarios' => $usuarios,
]);

// Profile page
renderView('profile', 'profile', ['user' => $user, 'profile' => $profile]);

// Profile edit
renderView('profile/edit', 'profile.edit', ['profile' => $profile]);

// Messages (view uses $message->sender->nombre_usuario and $message->contenido)
// Model has userEnvia() and mensaje — use mock objects to match the view
use Illuminate\Support\Carbon;
App\Models\Message::resolveRelationUsing('sender', function ($msg) {
    return $msg->belongsTo(App\Models\User::class, 'envia_id');
});
$messages = App\Models\Message::with('sender')
    ->where(function ($q) { $q->where('envia_id', 1)->where('recibe_id', 2); })
    ->orWhere(function ($q) { $q->where('envia_id', 2)->where('recibe_id', 1); })
    ->orderBy('created_at')
    ->get()
    ->map(function ($m) {
        $m->contenido = $m->mensaje;
        return $m;
    });
renderView('messages/2', 'messages', ['recipientId' => 2, 'messages' => $messages]);

// Chat
$chatMessages = App\Models\Message::with('userEnvia')
    ->where(function ($q) { $q->where('envia_id', 1)->where('recibe_id', 2); })
    ->orWhere(function ($q) { $q->where('envia_id', 2)->where('recibe_id', 1); })
    ->orderBy('created_at')
    ->get();
renderView('chat/2', 'chat.index', ['recipientId' => 2, 'messages' => $chatMessages]);

echo "Static HTML generation complete!\n";
