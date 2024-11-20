<?php
session_start();

$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'volan_app';

try {
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Kapcsolódási hiba: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kaposvár Helyi Járatok</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <style>
        :root {
            --primary-color:linear-gradient(to right, #211717,#b30000);
            --accent-color: #FFC107;
            --text-light: #fbfbfb;
            --shadow: 0 2px 4px rgba(0,0,0,0.1);
            --secondary-color: #3498db;
            --hover-color: #2980b9;
            --background-light: #f8f9fa;
            --shadow-color: rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #F5F5F5;
            color: #333;
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }

/*--------------------------------------------------------------------------------------------------------CSS - HEADER---------------------------------------------------------------------------------------------------*/
        .header {
            position: relative;
            background: var(--primary-color);
            color: var(--text-light);
            padding: 1rem;
            box-shadow: 0 2px 10px var(--shadow-color);
        }

        .header h1 {
            margin-left: 2%;
            text-align: center;
            font-size: 2rem;
            padding: 1rem 0;
            margin-right: 5%;
        }

        
/*--------------------------------------------------------------------------------------------------------HEADER END-----------------------------------------------------------------------------------------------------*/

/*--------------------------------------------------------------------------------------------------------CSS - OTHER PARTS----------------------------------------------------------------------------------------------*/
        .route-container {
            display: inline;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            padding: 2rem;
            max-width: 1000px;
            margin: 0 auto;
        }

        .route-card {
            background: var(--text-light);
            width: 1200px;
            border-radius: 20px;
            box-shadow: var(--shadow);
            padding: 1.5rem;
            transition: var(--transition);
            animation: fadeIn 0.5s ease-out;
            margin: 0 auto;
        }

        .route-card:hover{
            color: 000;
            background: #303639;
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .route-number {
            background: #b30000;
            display: inline;
            width: 3%;
            height: 60%;
            font-size: 1.5rem;
            font-weight: bold;
            border-radius: 5px;
            padding-left: 20px;
            padding-right: 15px;
            color: var(--text-light);
        }

        .route-name{
            display: inline;
            color: #636363;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .route-details {
            display: flex;
            flex-direction: column;
            gap: 0.8rem;
        }       
/*--------------------------------------------------------------------------------------------------------OTHER PARTS END------------------------------------------------------------------------------------------------*/

/*--------------------------------------------------------------------------------------------------------CSS - FOOTER---------------------------------------------------------------------------------------------------*/
        footer {
            text-align: center;
            padding: 10px;
            background-color: var(--primary-color);
            color: var(--text-light);
            border-radius: 10px;
            margin-top: 20px;
            box-shadow: var(--shadow);
            background: var(--primary-color);
            color: var(--text-light);
            padding: 3rem 2rem;
            margin-top: 4rem;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .footer-section h2 {
            margin-bottom: 1rem;
            color: var(--text-light);
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 0.5rem;
        }

        .footer-links a {
            color: var(--text-light);
            text-decoration: none;
            transition: var(--transition);
        }

        .footer-links a:hover {
            color: var(--accent-color);
        }
/*--------------------------------------------------------------------------------------------------------FOOTER END-----------------------------------------------------------------------------------------------------*/

/*--------------------------------------------------------------------------------------------------------CSS - @MEDIA---------------------------------------------------------------------------------------------------*/

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }

        @keyframes pulse {
            0% { opacity: 1; }
            50% { opacity: 0.7; }
            100% { opacity: 1; }
        }

        @media (max-width: 480px) {
            .header-content {
                padding: 1rem;
            }

            h1 {
                font-size: 1.5rem;
            }

            .route-container {
                grid-template-columns: 1fr;
                padding: 1rem;
            }
        }
/*--------------------------------------------------------------------------------------------------------@MEDIA END-----------------------------------------------------------------------------------------------------*/
        
    </style>
</head>
<body>
    <div class="header">
            <h1><i class="fas fa-bus"></i> Kaposvár Helyi Járatok</h1> 
        </div>

        <div id="routeContainer" class="route-container"></div>

<!-- -----------------------------------------------------------------------------------------------------HTML - FOOTER------------------------------------------------------------------------------------------------ -->
    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h2>Kaposvár közlekedés</h2>
                <p style="font-style: italic">Megbízható közlekedési szolgáltatások<br> az Ön kényelméért már több mint 50 éve.</p><br>
                <div class="social-links">
                    <a style="color: darkblue;" href="https://www.facebook.com/VOLANBUSZ/"><i class="fab fa-facebook"></i></a>
                    <a style="color: lightblue"href="https://x.com/volanbusz_hu?mx=2"><i class="fab fa-twitter"></i></a>
                    <a style="color: red"href="https://www.instagram.com/volanbusz/"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
           
            <div  class="footer-section">
                <h3>Elérhetőség</h3>
                <ul class="footer-links">
                    <li><i class="fas fa-phone"></i> +36-82/411-850</li>
                    <li><i class="fas fa-envelope"></i> titkarsag@kkzrt.hu</li>
                    <li><i class="fas fa-map-marker-alt"></i> 7400 Kaposvár, Cseri út 16.</li>
                    <li><i class="fas fa-map-marker-alt"></i> Áchim András utca 1.</li>
                </ul>
            </div>
        </div>
        <div style="text-align: center; margin-top: 2rem; padding-top: 2rem; border-top: 1px solid rgba(255,255,255,0.1);">
            <p>© 2024 Kaposvár közlekedési Zrt. Minden jog fenntartva.</p>
        </div>
    </footer>
<!-- -----------------------------------------------------------------------------------------------------FOOTER END--------------------------------------------------------------------------------------------------- -->

    <script>
        const busRoutes = [
            {
                "number": "12",
                "name": "Helyi autóbusz-állomás - Sopron u. - Laktanya",
                "nameBack": "Laktanya - Sopron u. - Helyi autóbusz-állomás",
                "start": ["05:00","05:30","05:55","06:10","06:30","07:05","07:30","09:90","10:00","10:35","11:00","12:30","13:00"
                ,"13:30","14:20","15:00","15:45","16:00","16:30","16:45","17:00","17:15","17:30","19:00","20:30"],
                "startBack": [],
                "goesBack": true,
            },
            {
                "number": "13",
                "name": "Helyi autóbusz-állomás - Kecelhegy - Helyi autóbusz-állomás",
                "start": ["06:10","07:10","08:10","09:10","12:10","13:25","14:10","15:40","16:10","17:10","19:10"],
                "startWeekend": [],
                "goesBack": false,
            },
            {
                "number": "20",
                "name": "Raktár u. - Laktanya - Videoton",
                "nameBack": "Videoton - Laktanya - Raktár u.",
                "start": ["06:15","06:40","08:00","10:00","13:05","14:15","16:20","21:10"],
                "startBack": [],
                "goesBack": true,
            },
            {
                "number": "21",
                "name": "Raktár u. - Videoton",
                "nameBack": "Videoton - Raktár u.",
                "start": ["05:20","07:00","17:40"],
                "startBack": [],
                "startSat": [],
                "startSatBack": [],
                "goesBack": true,
            },
            {
                "number": "23",
                "name": "Kaposfüred forduló - Füredi csp. - Kaposvári Egyetem",
                "nameBack": "Kaposvári Egyetem - Füredi csp. - Kaposfüred forduló",
                "start": ["05:00","06:55","07:10","07:20","12:55"],
                "startBack": [],
                "goesBack": true,
            },
            {
                "number": "26",
                "name": "Kaposfüred forduló - Losonc köz - Videoton - METYX",
                "nameBack": "METYX - Videoton - Losonc köz - Kaposfüred forduló",
                "start": ["05:05"],
                "startBack": [],
                "goesBack": true,
            },
            {
                "number": "27",
                "name": "Laktanya - Füredi u. csp. - KOMÉTA",
                "nameBack": "KOMÉTA - Füredi u. csp. - Laktanya",
                "start": ["04:55","07:10","13:00"],
                "startBack": [],
                "goesBack": true,
            },
            {
                "number": "31",
                "name": "Helyi autóbusz-állomás - Egyenesi u. forduló",
                "nameBack": "Egyenesi u. forduló - Helyi autóbusz-állomás",
                "start": ["05:40","06:20","06:40","07:00","07:30","09:00","12:00","13:00","14:00","15:00","16:00","17:00"
                ,"18:00","19:20"],
                "startBack": [],
                "startWeekend": [],
                "startWeekendBack": [],
                "goesBack": true,
            },
            {
                "number": "32",
                "name": "Helyi autóbuszállomás - Kecelhegy - Helyi autóbusz-állomás",
                "start": ["05:30","06:30","06:45","07:15","07:40","10:30","13:30","15:30"],
                "goesBack": false,
            },
            {
                "number": "33",
                "name": "Helyi aut. áll. - Egyenesi u. - Kecelhegy - Helyi aut. áll.",
                "start": ["04:30","05:00","09:30","11:30","12:30","14:35","16:30","17:30","18:20","20:00","20:40","22:30"],
                "goesBack": false,
            },
            {
                "number": "40",
                "name": "Koppány vezér u - 67-es út - Raktár u.",
                "nameBack": "Raktár u. - 67-es út - Koppány vezér u",
                "start": ["05:55","07:40","14:35","18:15"],
                "startBack": [],
                "goesBack": true,
            },
            {
                "number": "41",
                "name": "Koppány vezér u - Bartók B. u. - Raktár u.",
                "nameBack": "Raktár u. - Bartók B. u. - Koppány vezér u",
                "start": ["05:05","06:20","06:45","07:10","09:15","10:55","12:50","13:40","15:25","16:30","17:10","19:55","20:55"],
                "startBack": [],
                "startWeekend": [],
                "startWeekendBack": [],
                "goesBack": true,
            },
            {
                "number": "42",
                "name": "Töröcske forduló - Kórház - Laktanya",
                "nameBack": "Laktanya - Kórház - Töröcske forduló",
                "start": ["04:50","06:10","06:25","06:45","07:15","07:30","08:10","08:50","10:10","11:30","12:50","13:30","14:10"
                ,"15:20","15:40","16:10","16:45","17:40","18:20","19:00","20:50","22:10"],
                "startBack": [],
                "startWeekend": [],
                "startWeekendBack": [],
                "goesBack": true,
            },
            {
                "number": "43",
                "name": "Helyi autóbusz-állomás - Kórház- Laktanya - Raktár utca - Helyi autóbusz-állomás",
                "start": ["08:50","11:20"],
                "goesBack": false,
            },
            {
                "number": "44",
                "name": "Helyi autóbusz-állomás - Raktár utca - Laktanya -Arany János tér - Helyi autóbusz-állomás",
                "start": ["08:30","11:35","13:20"],
                "goesBack": false,
            },
            {
                "number": "45",
                "name": "Helyi autóbusz-állomás - 67-es út - Koppány vezér u.",
                "nameBack": "Koppány vezér u. - 67-es út - Helyi autóbusz-állomás",
                "start": ["04:35","10:45","12:00","12:40","19:45"],
                "startBack": [],
                "goesBack": true,
            },
            {
                "number": "46",
                "name": "Helyi autóbusz-állomás - Töröcske forduló",
                "nameBack": "Töröcske forduló - Helyi autóbusz-állomás",
                "start": ["06:10","06:30","13:15","20:35"],
                "startBack": [],
                "goesBack": true,
            },
            {
                "number": "47",
                "name": "Koppány vezér u.- Kórház - Kaposfüred forduló",
                "nameBack": "Kaposfüred forduló - Koppány vezér u.- Kórház",
                "start": ["04:45","06:00","06:15","08:30","12:10"],
                "startBack": [],
                "startWeekend": [],
                "startWeekendBack": [],
                "goesBack": true,
            },
            {
                "number": "51",
                "name": "Laktanya - Sopron u. - Rómahegy",
                "nameBack": "Rómahegy - Sopron u. - Laktanya",
                "startWeekend": ["04:45","05:20","06:30","07:30","08:30","09:30","10:30","11:30","12:30","13:30","14:30"
                ,"16:45","17:50","18:30","20:30","22:20"],
                "startWeekendBack": ["04:50","05:50","07:00","08:00","10:00","11:00","12:00","13:00","14:00","15:00"
                ,"16:15","18:00","20:00","22:00"],
                "goesBack": true,
            },
            {
                "number": "61",
                "name": "Helyi- autóbuszállomás - Béla király u.",
                "nameBack": "Béla király u. - Helyi- autóbuszállomás",
                "start": [],
                "startBack": [],
                "startWeekend": [],
                "startWeekendBack": [],
                "goesBack": true,
            },
            {
                "number": "62",
                "name": "Helyi autóbusz-állomás - Városi fürdő - Béla király u.",
                "nameBack": "Béla király u. - Városi fürdő - Helyi autóbusz-állomás",
                "start": [],
                "startBack": [],
                "startWeekend": [],
                "startWeekendBack": [],
                "goesBack": true,
            },
            {
                "number": "70",
                "name": "Helyi autóbusz-állomás - Kaposfüred",
                "nameBack": "Kaposfüred - Helyi autóbusz-állomás",
                "start": [],
                "startBack": [],
                "startWeekend": [],
                "startWeekendBack": [],
                "goesBack": true,
            },
            {
                "number": "71",
                "name": "Kaposfüred forduló - Kaposszentjakab forduló",
                "nameBack": "Kaposszentjakab forduló - Kaposfüred forduló",
                "start": [],
                "startBack": [],
                "startWeekend": [],
                "startWeekendBack": [],
                "goesBack": true,
            },
            {
                "number": "72",
                "name": "Kaposfüred forduló - Hold u. - Kaposszentjakab forduló",
                "nameBack": "Kaposszentjakab forduló - Hold u. - Kaposfüred forduló",
                "start": [],
                "startBack": [],
                "startWeekend": [],
                "startWeekendBack": [],
                "goesBack": true,
            },
            {
                "number": "73",
                "name": "Kaposfüred forduló - KOMÉTA - Kaposszentjakab forduló",
                "nameBack": "Kaposszentjakab forduló - KOMÉTA - Kaposfüred forduló",
                "start": [],
                "startBack": [],
                "goesBack": true,
            },
            {
                "number": "74",
                "name": "Hold utca - Helyi autóbusz-állomás",
                "start": ["05:30","06:30","06:45","07:15","07:40","10:30","13:30","15:30"],
                "goesBack": false,
            },
            {
                "number": "75",
                "name": "Helyi autóbusz-állomás - Kaposszentjakab",
                "nameBack": "Kaposszentjakab - Helyi autóbusz-állomás",
                "start": [],
                "startBack": [],
                "startWeekend": [],
                "startWeekendBack": [],
                "goesBack": true,
            },
            {
                "number": "81",
                "name": "Helyi autóbusz-állomás - Hősök temploma - Toponár forduló",
                "nameBack": "Toponár forduló - Hősök temploma - Helyi autóbusz-állomás",
                "start": [],
                "startBack": [],
                "goesBack": true,
            },
            {
                "number": "82",
                "name": "Helyi autóbusz-állomás - Kórház - Toponár Szabó P. u.",
                "nameBack": "Toponár Szabó P. u. - Kórház - Helyi autóbusz-állomás",
                "start": [],
                "startBack": [],
                "goesBack": true,
            },
            {
                "number": "83",
                "name": "Helyi autóbusz-állomás - Szabó P. u. - Toponár forduló",
                "nameBack": "Toponár forduló - Szabó P. u. - Helyi autóbusz-állomás",
                "start": [],
                "startBack": [],
                "startWeekend": [],
                "startWeekendBack": [],
                "goesBack": true,
            },
            {
                "number": "84",
                "name": "Helyi autóbusz-állomás - Toponár, forduló - Répáspuszta",
                "nameBack": "Répáspuszta - Toponár, forduló - Helyi autóbusz-állomás",
                "start": [],
                "startBack": [],
                "goesBack": true,
            },
            {
                "number": "85",
                "name": "Helyi autóbusz-állomás - Kisgát- Helyi autóbusz-állomás",
                "start": ["05:30","06:30","06:45","07:15","07:40","10:30","13:30","15:30"],
                "goesBack": false,
            },
            {
                "number": "86",
                "name": "Helyi autóbusz-állomás - METYX - Szennyvíztelep",
                "nameBack": "Szennyvíztelep - METYX - Helyi autóbusz-állomás",
                "start": [],
                "startBack": [],
                "goesBack": true,
            },
            {
                "number": "87",
                "name": "Helyi autóbusz állomás - Videoton - METYX",
                "nameBack": "METYX - Videoton - Helyi autóbusz állomás",
                "start": [],
                "startBack": [],
                "startWeekend": [],
                "startWeekendBack": [],
                "goesBack": true,
            },
            {
                "number": "88",
                "name": "Helyi autóbusz-állomás - Videoton",
                "nameBack": "Videoton - Helyi autóbusz-állomás",
                "start": [],
                "startBack": [],
                "startWeekend": [],
                "startWeekendBack": [],
                "goesBack": true,
            },
            {
                "number": "89",
                "name": "Helyi autóbusz-állomás - Kaposvári Egyetem",
                "nameBack": "Kaposvári Egyetem - Helyi autóbusz-állomás",
                "start": [],
                "startBack": [],
                "goesBack": true,
            },
            {
                "number": "90",
                "name": "Helyi autóbusz-állomás - Rómahegy",
                "nameBack": "Rómahegy - Helyi autóbusz-állomás",
                "start": [],
                "startBack": [],
                "goesBack": true,
            },
            {
                "number": "91",
                "name": "Rómahegy - Pázmány P u. - Füredi u. csp.",
                "nameBack": "Füredi u. csp. - Pázmány P u. - Rómahegy",
                "start": [],
                "startBack": [],
                "goesBack": true,
            }

        ];

        function displayRoutes(filter = "all") {
            const routeContainer = document.getElementById('routeContainer');
            routeContainer.innerHTML = "";

            const filteredRoutes = filter === "all" 
                ? busRoutes 
                : busRoutes.filter(route => route.category === filter);

            filteredRoutes.forEach((route, index) => {
                const routeCard = document.createElement('div');
                routeCard.className = 'route-card';
                routeCard.style.animationDelay = `${index * 0.1}s`;

                routeCard.innerHTML = `
                    <div id="route-details" class="route-number">
                        ${route.number}
                    </div>
                    <div class="route-name">
                        ${route.name}
                    </div>
                `;
                routeContainer.appendChild(routeCard);

            });
        }

        // Mobilbarát menü
        function setupMobileMenu() {
            const header = document.querySelector('header');
            const filterButtons = document.getElementById('filterButtons');
            
            let lastScroll = 0;
            window.addEventListener('scroll', () => {
                const currentScroll = window.pageYOffset;
                
                if (currentScroll > lastScroll && currentScroll > 100) {
                    header.style.transform = 'translateY(-100%)';
                } else {
                    header.style.transform = 'translateY(0)';
                }
                lastScroll = currentScroll;
            });
        }

        setupMobileMenu();

        
    </script>
</body>
</html>