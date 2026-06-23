<?php

namespace Database\Seeders;

use App\Models\Actualite;
use App\Models\Category;
use App\Models\Formation;
use App\Models\Galerie;
use App\Models\Role;
use App\Models\Temoignage;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::create(['name' => 'admin', 'label' => 'Administrateur']);
        Role::create(['name' => 'editor', 'label' => 'Éditeur']);

        User::create([
            'name' => 'Administrateur IIE',
            'email' => env('ADMIN_EMAIL', 'admin@iie.edu'),
            'password' => Hash::make(env('ADMIN_PASSWORD', 'password')),
            'role_id' => $adminRole->id,
            'is_active' => true,
        ]);

        $categories = [
            ['name' => 'Réseaux & Cybersécurité', 'slug' => 'reseaux-cybersecurite', 'icon' => 'fa-shield-halved', 'description' => 'Formations en réseaux informatiques et cybersécurité'],
            ['name' => 'Cloud & Systèmes', 'slug' => 'cloud-systemes', 'icon' => 'fa-cloud', 'description' => 'Administration cloud et systèmes Linux'],
            ['name' => 'Développement', 'slug' => 'developpement', 'icon' => 'fa-code', 'description' => 'Développement web et mobile'],
            ['name' => 'Data & IA', 'slug' => 'data-ia', 'icon' => 'fa-brain', 'description' => 'Data Science et Intelligence Artificielle'],
            ['name' => 'Management', 'slug' => 'management', 'icon' => 'fa-briefcase', 'description' => 'Gestion de projet et bureautique'],
        ];

        foreach ($categories as $i => $cat) {
            Category::create([...$cat, 'sort_order' => $i + 1]);
        }

        $formations = [
            ['name' => 'CCNA', 'category' => 'reseaux-cybersecurite', 'duration' => '6 mois', 'price' => 850000, 'popular' => true, 'level' => 'Bac+2', 'cert' => 'Cisco CCNA', 'desc' => 'Formation complète aux réseaux Cisco couvrant le routage, le switching et la sécurité réseau.'],
            ['name' => 'Cybersécurité', 'category' => 'reseaux-cybersecurite', 'duration' => '8 mois', 'price' => 1200000, 'popular' => true, 'level' => 'Bac+2', 'cert' => 'CompTIA Security+', 'desc' => 'Maîtrisez les fondamentaux de la cybersécurité, la gestion des risques et la protection des systèmes.'],
            ['name' => 'SOC Analyst', 'category' => 'reseaux-cybersecurite', 'duration' => '6 mois', 'price' => 1100000, 'popular' => true, 'level' => 'Bac+3', 'cert' => 'SOC Analyst Certificate', 'desc' => 'Devenez analyste SOC capable de détecter, analyser et répondre aux incidents de sécurité.'],
            ['name' => 'Ethical Hacking', 'category' => 'reseaux-cybersecurite', 'duration' => '7 mois', 'price' => 1300000, 'popular' => false, 'level' => 'Bac+3', 'cert' => 'CEH', 'desc' => 'Apprenez les techniques de pentesting et d\'audit de sécurité informatique.'],
            ['name' => 'Cloud Computing', 'category' => 'cloud-systemes', 'duration' => '5 mois', 'price' => 950000, 'popular' => true, 'level' => 'Bac+2', 'cert' => 'AWS Cloud Practitioner', 'desc' => 'Formation aux services cloud AWS, Azure et Google Cloud Platform.'],
            ['name' => 'Linux Administration', 'category' => 'cloud-systemes', 'duration' => '4 mois', 'price' => 750000, 'popular' => false, 'level' => 'Bac', 'cert' => 'LPIC-1', 'desc' => 'Administration système Linux : installation, configuration, sécurité et scripting.'],
            ['name' => 'Développement Web', 'category' => 'developpement', 'duration' => '8 mois', 'price' => 900000, 'popular' => true, 'level' => 'Bac', 'cert' => 'Certificat IIE Web Dev', 'desc' => 'Maîtrisez HTML, CSS, JavaScript, PHP/Laravel et les frameworks modernes.'],
            ['name' => 'Développement Mobile', 'category' => 'developpement', 'duration' => '7 mois', 'price' => 1000000, 'popular' => false, 'level' => 'Bac+2', 'cert' => 'Certificat IIE Mobile', 'desc' => 'Créez des applications mobiles natives et cross-platform avec Flutter et React Native.'],
            ['name' => 'Data Science', 'category' => 'data-ia', 'duration' => '9 mois', 'price' => 1400000, 'popular' => true, 'level' => 'Bac+3', 'cert' => 'Certificat Data Science IIE', 'desc' => 'Analyse de données, machine learning et visualisation avec Python et R.'],
            ['name' => 'Intelligence Artificielle', 'category' => 'data-ia', 'duration' => '10 mois', 'price' => 1600000, 'popular' => true, 'level' => 'Bac+3', 'cert' => 'Certificat IA IIE', 'desc' => 'Deep learning, NLP, computer vision et déploiement de modèles IA.'],
            ['name' => 'Bureautique Professionnelle', 'category' => 'management', 'duration' => '3 mois', 'price' => 350000, 'popular' => false, 'level' => 'Aucun', 'cert' => 'TIC Pro', 'desc' => 'Maîtrisez Word, Excel, PowerPoint et les outils collaboratifs professionnels.'],
            ['name' => 'Gestion de Projet', 'category' => 'management', 'duration' => '4 mois', 'price' => 650000, 'popular' => false, 'level' => 'Bac+2', 'cert' => 'PMP Prep', 'desc' => 'Méthodologies Agile, Scrum, planification et gestion d\'équipes projet.'],
        ];

        foreach ($formations as $i => $f) {
            $category = Category::where('slug', $f['category'])->first();
            Formation::create([
                'category_id' => $category->id,
                'name' => $f['name'],
                'slug' => Str::slug($f['name']),
                'description' => $f['desc'],
                'short_description' => Str::limit($f['desc'], 120),
                'duration' => $f['duration'],
                'price' => $f['price'],
                'level_required' => $f['level'],
                'certification' => $f['cert'],
                'debouches' => 'Technicien, Ingénieur, Consultant, Freelance dans le domaine '.$f['name'],
                'programme' => [
                    'Module 1 : Fondamentaux et introduction',
                    'Module 2 : Concepts avancés et pratique',
                    'Module 3 : Projets pratiques et cas réels',
                    'Module 4 : Certification et mise en situation professionnelle',
                ],
                'is_popular' => $f['popular'],
                'is_active' => true,
                'sort_order' => $i + 1,
            ]);
        }

        $temoignages = [
            ['name' => 'Aminata Koné', 'formation' => 'Cybersécurité', 'content' => 'La formation en cybersécurité à l\'IIE a transformé ma carrière. Les formateurs sont experts et le matériel est de qualité internationale.'],
            ['name' => 'Kouassi Jean', 'formation' => 'Développement Web', 'content' => 'Grâce à l\'IIE, j\'ai décroché un poste de développeur full-stack dans une multinationale. La pédagogie pratique fait toute la différence.'],
            ['name' => 'Fatou Diallo', 'formation' => 'Data Science', 'content' => 'Un institut d\'excellence ! Les projets réels et l\'accompagnement personnalisé m\'ont permis de maîtriser Python et le machine learning.'],
            ['name' => 'Yao Emmanuel', 'formation' => 'CCNA', 'content' => 'J\'ai obtenu ma certification CCNA du premier coup grâce à la préparation intensive de l\'IIE. Je recommande vivement !'],
            ['name' => 'Marie-Claire B.', 'formation' => 'Cloud Computing', 'content' => 'Formation complète sur AWS et Azure. Les labs pratiques et les simulations d\'examens sont un vrai plus.'],
            ['name' => 'Ibrahim Traoré', 'formation' => 'SOC Analyst', 'content' => 'L\'IIE m\'a formé aux outils SIEM et à l\'analyse d\'incidents. Aujourd\'hui je travaille dans un SOC international.'],
        ];

        foreach ($temoignages as $i => $t) {
            Temoignage::create([...$t, 'rating' => 5, 'is_active' => true, 'sort_order' => $i + 1]);
        }

        $actualites = [
            ['title' => 'Ouverture des inscriptions 2026', 'type' => 'evenement', 'excerpt' => 'Les inscriptions pour la rentrée 2026 sont ouvertes. Places limitées !'],
            ['title' => 'Séminaire Cybersécurité : Tendances 2026', 'type' => 'seminaire', 'excerpt' => 'Rejoignez nos experts pour un séminaire gratuit sur les menaces cyber actuelles.'],
            ['title' => 'IIE remporte le prix de l\'excellence', 'type' => 'blog', 'excerpt' => 'Notre institut a été récompensé pour la qualité de ses formations IT.'],
            ['title' => 'Atelier Intelligence Artificielle', 'type' => 'atelier', 'excerpt' => 'Découvrez ChatGPT, les LLM et l\'IA générative lors de notre atelier pratique.'],
            ['title' => 'Concours de programmation IIE 2026', 'type' => 'concours', 'excerpt' => 'Participez à notre hackathon annuel avec des prix à la clé.'],
        ];

        foreach ($actualites as $a) {
            Actualite::create([
                'title' => $a['title'],
                'slug' => Str::slug($a['title']),
                'excerpt' => $a['excerpt'],
                'content' => '<p>'.$a['excerpt'].'</p><p>L\'International Institute of Excellence (IIE) continue de se démarquer par la qualité de ses programmes de formation. Nos étudiants bénéficient d\'un encadrement personnalisé, d\'équipements modernes et d\'un réseau de partenaires industriels.</p><p>Pour plus d\'informations, contactez-nous ou visitez notre campus.</p>',
                'type' => $a['type'],
                'is_published' => true,
                'is_featured' => true,
                'user_id' => 1,
                'event_date' => now()->addDays(rand(10, 60)),
            ]);
        }

        $galerieItems = [
            ['title' => 'Cérémonie de remise des diplômes', 'type' => 'photo', 'category' => 'Activités'],
            ['title' => 'Laboratoire réseaux Cisco', 'type' => 'photo', 'category' => 'Infrastructure'],
            ['title' => 'Atelier cybersécurité', 'type' => 'photo', 'category' => 'Ateliers'],
            ['title' => 'Hackathon étudiant 2025', 'type' => 'photo', 'category' => 'Concours'],
            ['title' => 'Conférence IA', 'type' => 'photo', 'category' => 'Séminaires'],
            ['title' => 'Visite du campus', 'type' => 'video', 'category' => 'Campus'],
        ];

        foreach ($galerieItems as $i => $g) {
            Galerie::create([
                ...$g,
                'file_path' => 'galeries/placeholder-'.($i + 1).'.jpg',
                'description' => 'Activité IIE - '.$g['title'],
                'is_active' => true,
                'sort_order' => $i + 1,
            ]);
        }
    }
}
