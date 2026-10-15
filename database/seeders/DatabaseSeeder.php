<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Academic;
use App\Models\Publication;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::updateOrCreate(
            ['email' => 'admin@utpweb.com'],
            ['name' => 'Administrator', 'email' => 'admin@utpweb.com', 'password' => Hash::make('admin123')]
        );

        $scholars = [

            // 1
            [
                'slug'            => 'zainal-arif-burhanudin',
                'name'            => 'Zainal Arif bin Burhanudin',
                'title'           => 'Associate Professor',
                'email'           => 'zainalarif.burhanudin@utp.edu.my',
                'phone'           => '+60 5-368 7802',
                'department'      => 'Electrical & Electronics Engineering',
                'institute'       => 'Institute of Smart & Sustainable Living',
                'centre'          => 'Centre of Innovative Nanostructures & Nanodevices (COINN)',
                'office_address'  => "23-03-011\nUniversiti Teknologi PETRONAS\nBandar Seri Iskandar, 32610\nPerak",
                'biography'       => 'Assoc. Prof. Ts Dr Zainal Arif bin Burhanudin is an experienced academician with a demonstrated history of working in the higher education industry. He is skilled in nanoscale semiconductor electronics, devices and materials. He received numerous funding from national and international institutions. He supervised graduate students and published in high impact journals.',
                'specializations' => ['Advanced Materials', 'Applied Physical', 'Engineering & System Design', 'Environmental & Sustainable Technologies', 'Nanotechnology'],
                'qualifications'  => [
                    '2007, PhD in Nanotechnology by Shizuoka University, Hamamatsu, Japan',
                    '2000, Master in Semiconductor Science and Technology by Imperial College of Science, Technology & Medicine, London',
                    '1993, Degree in Engineering Physics by University of Tulsa, Oklahoma',
                ],
                'scopus_author_id' => '55961535400',
                'scopus_documents' => 75,
                'scopus_citations' => 450,
                'scopus_hindex'    => 12,
                'scopus_coauthors' => 102,
                'gscholar_profile' => '6zYQw0AAAAJ&hl',
                'gscholar_citations' => 596,
                'gscholar_hindex'  => 14,
                'other_links'      => [
                    ['label' => 'UTP Personal Page', 'url' => 'https://www.utp.edu.my'],
                    ['label' => 'UTP Scholarly Publication', 'url' => 'https://khub.utp.edu.my'],
                ],
                'courses_teaching' => ['EEE 3314 - Semiconductor Devices', 'EEE 4414 - Nanoscale Electronics', 'EEE 2211 - Engineering Physics'],
                'memberships'      => ['IEEE Senior Member', 'Malaysian Institute of Physics', 'Institute of Electrical Engineers (IEE)'],
                'publications'     => [
                    ['title' => 'Electrical characterisation of nanocrystalline silicon thin film transistors', 'authors' => 'Zainal Arif B., et al.', 'year' => 2021, 'journal' => 'Thin Solid Films', 'volume' => '720', 'type' => 'journal'],
                    ['title' => 'Effect of deposition temperature on nc-Si TFT performance', 'authors' => 'Zainal Arif B., Mohd Anas A.', 'year' => 2019, 'journal' => 'Microelectronics Journal', 'volume' => '91', 'type' => 'journal'],
                    ['title' => 'Low-temperature silicon nanocrystal formation for memory devices', 'authors' => 'Zainal Arif B., et al.', 'year' => 2018, 'journal' => 'IEEE Electron Device Letters', 'type' => 'journal', 'url' => 'https://doi.org/10.1109/LED.2018.2849060'],
                ],
            ],

            // 2
            [
                'slug'            => 'nursyarizal-mohd-nor',
                'name'            => 'Nursyarizal bin Mohd Nor',
                'title'           => 'Associate Professor',
                'email'           => 'nursyarizal@utp.edu.my',
                'phone'           => '+60 5-368 7890',
                'department'      => 'Integrated Engineering',
                'institute'       => 'Institute of Emerging Digital Technologies',
                'centre'          => 'Offshore Engineering & Autonomous Centre (OEAC)',
                'office_address'  => "15-02-003\nUniversiti Teknologi PETRONAS\nBandar Seri Iskandar, 32610\nPerak",
                'biography'       => 'Dr. Nursyarizal bin Mohd Nor is an Associate Professor in the Electrical and Electronics Engineering Department. He has extensive research experience in power systems, renewable energy integration, and smart grid technologies. He has published over 60 papers in prestigious international journals and conferences.',
                'specializations' => ['Power Systems', 'Renewable Energy', 'Smart Grid Technology', 'Load Forecasting', 'Energy Efficiency'],
                'qualifications'  => [
                    '2009, PhD in Electrical Engineering by University of Edinburgh, UK',
                    '2002, Master of Engineering by Universiti Teknologi Malaysia',
                    '1998, Bachelor of Engineering by Universiti Teknologi Malaysia',
                ],
                'scopus_author_id' => '35274859800',
                'scopus_documents' => 62,
                'scopus_citations' => 890,
                'scopus_hindex'    => 17,
                'scopus_coauthors' => 145,
                'gscholar_citations' => 1102,
                'gscholar_hindex'  => 19,
                'research_projects' => [
                    'Smart Grid Implementation for Industrial Zone in Malaysia (MOSTI, RM 450,000)',
                    'Offshore Wind Energy Integration Study (PETRONAS Research, RM 280,000)',
                    'AI-Based Load Forecasting for TNB (TNB Research, RM 320,000)',
                ],
                'courses_teaching' => [
                    ['year' => '2024/2025', 'course_code' => 'EEE 5143', 'course_name' => 'Advanced Wireless Communications'],
                    ['year' => '2024/2025', 'course_code' => 'EEE 4183', 'course_name' => 'Telecommunications Systems Design'],
                    ['year' => '2023/2024', 'course_code' => 'EEE 5143', 'course_name' => 'Advanced Wireless Communications'],
                    ['year' => '2023/2024', 'course_code' => 'EEE 4183', 'course_name' => 'Telecommunications Systems Design'],
                    ['year' => '2023/2024', 'course_code' => 'EEE 3113', 'course_name' => 'Signals & Systems'],
                    ['year' => '2022/2023', 'course_code' => 'EEE 5153', 'course_name' => 'Cognitive Radio Networks'],
                    ['year' => '2022/2023', 'course_code' => 'EEE 4183', 'course_name' => 'Telecommunications Systems Design'],
                ],
                'memberships'      => ['IEEE Power & Energy Society', 'Institution of Engineers Malaysia (IEM)', 'CIGRE Member'],
                'university_activities' => ['Faculty Research Committee Member', 'Postgraduate Programme Coordinator', 'IEEE Student Branch Advisor'],
                'publications'     => [
                    ['title' => 'Optimal integration of solar PV in distribution networks using multi-objective optimization', 'authors' => 'Nursyarizal M.N., et al.', 'year' => 2022, 'journal' => 'IEEE Access', 'type' => 'journal', 'url' => 'https://doi.org/10.1109/ACCESS.2022.1234567'],
                    ['title' => 'Short-term load forecasting using deep learning with weather features', 'authors' => 'Nursyarizal M.N., Ahmad Z., Idris M.', 'year' => 2021, 'journal' => 'Energy', 'volume' => '225', 'type' => 'journal'],
                    ['title' => 'A review of demand response in smart grid: State of the art', 'authors' => 'Nursyarizal M.N., Idris M.Y.', 'year' => 2020, 'journal' => 'Renewable and Sustainable Energy Reviews', 'volume' => '118', 'type' => 'journal'],
                    ['title' => 'Offshore platform power management using hybrid renewable system', 'authors' => 'Nursyarizal M.N., et al.', 'year' => 2019, 'journal' => 'Applied Energy', 'type' => 'journal'],
                ],
            ],

            // 3
            [
                'slug'            => 'fawnizu-azmadi-hussin',
                'name'            => 'Fawnizu Azmadi bin Hussin',
                'title'           => 'Associate Professor',
                'email'           => 'fawnizu@utp.edu.my',
                'phone'           => '+60 5-368 7513',
                'department'      => 'Electrical & Electronics Engineering',
                'institute'       => 'Institute of Smart & Sustainable Living',
                'centre'          => 'Smart Infrastructure Modelling & Monitoring (SIMM)',
                'office_address'  => "23-03-024\nUniversiti Teknologi PETRONAS\nBandar Seri Iskandar, 32610\nPerak",
                'biography'       => 'Dr. Fawnizu Azmadi bin Hussin is an accomplished academic and researcher in digital signal processing, biomedical engineering, and machine learning. He leads several national research grants and has collaborated with international institutions in the UK, Japan, and Australia. He is passionate about applying AI techniques to healthcare diagnostics.',
                'specializations' => ['Digital Signal Processing', 'Biomedical Engineering', 'Machine Learning', 'EEG/ECG Analysis', 'Embedded Systems'],
                'qualifications'  => [
                    '2005, PhD in Electrical Engineering by University of Newcastle upon Tyne, UK',
                    '2000, Master of Science by Universiti Teknologi Malaysia',
                    '1997, Bachelor of Electrical Engineering by Universiti Teknologi Malaysia',
                ],
                'scopus_author_id' => '24448899800',
                'scopus_documents' => 89,
                'scopus_citations' => 1240,
                'scopus_hindex'    => 20,
                'scopus_coauthors' => 198,
                'gscholar_citations' => 1540,
                'gscholar_hindex'  => 22,
                'researchgate_profile' => 'Fawnizu-Hussin',
                'rg_publications'  => 89,
                'rg_citations'     => 1180,
                'rg_hindex'        => 20,
                'rg_reads'         => 42600,
                'research_projects' => [
                    'AI-Driven Epilepsy Detection from EEG Signals (Ministry of Health, RM 500,000)',
                    'Wearable ECG Monitor for Cardiac Arrhythmia Detection (MOSTI, RM 380,000)',
                ],
                'industrial_experience' => "2 years at Motorola Solutions Malaysia as RF Design Engineer\n1 year at Intel Malaysia as Digital Logic Design Engineer",
                'courses_teaching' => ['EEE 2116 - Signals & Systems', 'EEE 3226 - Digital Signal Processing', 'EEE 5226 - Advanced DSP & Applications'],
                'memberships'      => ['IEEE Engineering in Medicine and Biology Society', 'IEEE Signal Processing Society', 'Institution of Engineers Malaysia (IEM)'],
                'publications'     => [
                    ['title' => 'Automated epileptic seizure detection using wavelet-based features from EEG signals', 'authors' => 'Fawnizu A.H., et al.', 'year' => 2022, 'journal' => 'Biomedical Signal Processing and Control', 'volume' => '68', 'type' => 'journal'],
                    ['title' => 'Deep learning for ECG-based cardiac arrhythmia classification: A systematic review', 'authors' => 'Fawnizu A.H., Nurul H., Mohamad S.', 'year' => 2021, 'journal' => 'Journal of Medical Systems', 'type' => 'journal'],
                    ['title' => 'Real-time drowsiness detection using EEG and machine learning', 'authors' => 'Fawnizu A.H., Ahmad F.', 'year' => 2020, 'journal' => 'Expert Systems with Applications', 'volume' => '145', 'type' => 'journal'],
                ],
            ],

            // 4
            [
                'slug'            => 'mohd-haris-md-khir',
                'name'            => 'Mohd Haris bin Md Khir',
                'title'           => 'Associate Professor',
                'email'           => 'mohdharis@utp.edu.my',
                'phone'           => '+60 5-368 7654',
                'department'      => 'Electrical & Electronics Engineering',
                'institute'       => 'Institute of Smart & Sustainable Living',
                'centre'          => 'Smart Infrastructure Modelling & Monitoring (SIMM)',
                'office_address'  => "23-02-018\nUniversiti Teknologi PETRONAS\nBandar Seri Iskandar, 32610\nPerak",
                'biography'       => 'Dr. Mohd Haris specialises in microwave engineering, antenna design, and wireless communications. He has contributed significantly to 5G antenna research and has filed several patents. His work on reconfigurable antennas has been cited widely in the international community.',
                'specializations' => ['Microwave Engineering', 'Antenna Design', '5G Communications', 'RF & Microwave Circuits', 'Electromagnetic Compatibility'],
                'qualifications'  => [
                    '2008, PhD in Electrical Engineering by Universiti Putra Malaysia',
                    '2002, Master in Electrical Engineering by Universiti Teknologi Malaysia',
                    '1999, Bachelor of Electrical Engineering by Universiti Sains Malaysia',
                ],
                'scopus_documents' => 54,
                'scopus_citations' => 620,
                'scopus_hindex'    => 14,
                'scopus_coauthors' => 88,
                'gscholar_citations' => 742,
                'gscholar_hindex'  => 15,
                'courses_teaching' => ['EEE 3123 - Electromagnetic Fields', 'EEE 4153 - Microwave Engineering', 'EEE 4173 - Antenna Theory & Design'],
                'memberships'      => ['IEEE Antennas and Propagation Society', 'IEEE Microwave Theory Society', 'Institution of Engineers Malaysia (IEM)'],
                'publications'     => [
                    ['title' => 'Compact dual-band MIMO antenna for 5G mobile devices', 'authors' => 'Mohd Haris M.K., et al.', 'year' => 2022, 'journal' => 'IEEE Antennas and Wireless Propagation Letters', 'type' => 'journal'],
                    ['title' => 'Frequency reconfigurable patch antenna using PIN diodes', 'authors' => 'Mohd Haris M.K., Zulkifli F.Y.', 'year' => 2020, 'journal' => 'Progress in Electromagnetics Research', 'volume' => '168', 'type' => 'journal'],
                ],
            ],

            // 5
            [
                'slug'            => 'idris-bin-ismail',
                'name'            => 'Idris bin Ismail',
                'title'           => 'Professor',
                'email'           => 'idris.ismail@utp.edu.my',
                'phone'           => '+60 5-368 7301',
                'department'      => 'Electrical & Electronics Engineering',
                'institute'       => 'Institute of Emerging Digital Technologies',
                'centre'          => 'Center for Advanced Technology in Telecommunications (CATT)',
                'office_address'  => "23-03-001\nUniversiti Teknologi PETRONAS\nBandar Seri Iskandar, 32610\nPerak",
                'biography'       => 'Professor Idris bin Ismail is a senior academic with over 25 years of teaching and research experience. He has been a principal investigator on over 20 funded research projects totalling more than RM 5 million. He has supervised more than 30 PhD and master students. His research spans telecommunications systems, cognitive radio, and spectrum management.',
                'specializations' => ['Telecommunications Systems', 'Cognitive Radio', 'Spectrum Management', 'Wireless Networks', 'Signal Processing'],
                'qualifications'  => [
                    '1996, PhD in Electrical Engineering by University of Birmingham, UK',
                    '1991, Master of Science by University of Birmingham, UK',
                    '1988, Bachelor of Engineering by University of Malaya',
                ],
                'awards' => [
                    'Best Paper Award — IEEE International Conference on Communications (ICC 2022), Seoul',
                    'Top Researcher Award — Universiti Teknologi PETRONAS (2021)',
                    'Excellence in Research Award — Ministry of Higher Education Malaysia (2019)',
                    'Outstanding Senior Researcher — Malaysian Communications & Multimedia Commission (2017)',
                    'Vice-Chancellor\'s Award for Research Excellence — UTP (2015)',
                ],
                'recognition' => [
                    'IEEE Fellow — elevated for contributions to cognitive radio and spectrum management (2020)',
                    'Academician, Academy of Sciences Malaysia (2018)',
                    'Chartered Engineer (CEng), UK Engineering Council (2010)',
                    'Top 1% Highly Cited Researcher — Clarivate Analytics Web of Science (2021, 2022)',
                    'Invited Keynote Speaker — IEEE PIMRC 2022, Kyoto, Japan',
                ],
                'scopus_author_id' => '12345678900',
                'scopus_documents' => 134,
                'scopus_citations' => 2850,
                'scopus_hindex'    => 28,
                'scopus_coauthors' => 312,
                'gscholar_citations' => 3400,
                'gscholar_hindex'  => 31,
                'researchgate_profile' => 'Idris-Ismail',
                'rg_publications'  => 134,
                'rg_citations'     => 2700,
                'rg_hindex'        => 28,
                'rg_reads'         => 95000,
                'research_projects' => [
                    'Cognitive Radio Spectrum Sensing for Malaysia (MOSTI Flagship, RM 1.2M)',
                    'Dynamic Spectrum Access in 5G Networks (MCMC Grant, RM 650,000)',
                    'AI-Powered Network Slicing for IoT (PETRONAS Research, RM 480,000)',
                ],
                'supervision_info' => "Completed: 18 PhD, 14 Master's\nOngoing: 6 PhD, 4 Master's\nPostdoctoral researchers supervised: 5",
                'consultation_complete' => [
                    ['year' => '2023', 'title' => 'Spectrum Interference Assessment for 700 MHz Band Deployment', 'membership' => 'Malaysian Communications & Multimedia Commission (MCMC)', 'funder' => 'MCMC Malaysia'],
                    ['year' => '2022', 'title' => 'National 5G Rollout — Cognitive Radio Feasibility Study', 'membership' => 'Ministry of Communications & Digital', 'funder' => 'Ministry of Communications & Digital, Malaysia'],
                    ['year' => '2021', 'title' => 'Wireless Network Design for Smart Industrial Zone, Pengerang', 'membership' => 'PETRONAS Dagangan Berhad', 'funder' => 'PETRONAS'],
                    ['year' => '2020', 'title' => 'Radio Frequency Spectrum Audit — Sabah & Sarawak Region', 'membership' => 'Suruhanjaya Komunikasi & Multimedia Malaysia', 'funder' => 'SKMM'],
                    ['year' => '2019', 'title' => 'IoT Connectivity Architecture for Palm Oil Industry', 'membership' => 'Malaysian Palm Oil Board (MPOB)', 'funder' => 'MPOB Research Grant'],
                ],
                'intellectual_properties' => [
                    ['year' => '2023', 'reference_no' => 'PI2023000412', 'ip_type' => 'Patent', 'title' => 'Adaptive Spectrum Sensing Method for Dynamic Cognitive Radio Networks Using Deep Reinforcement Learning', 'status_ip' => 'Pending'],
                    ['year' => '2022', 'reference_no' => 'PI2022001897', 'ip_type' => 'Patent', 'title' => 'Energy-Efficient Network Slicing Algorithm for Heterogeneous 5G-IoT Environments', 'status_ip' => 'Filed'],
                    ['year' => '2021', 'reference_no' => 'PI2021003510', 'ip_type' => 'Patent', 'title' => 'Cooperative Spectrum Sensing Protocol with Byzantine Fault Tolerance for Cognitive Radio Networks', 'status_ip' => 'Granted'],
                    ['year' => '2020', 'reference_no' => 'LY2020000228', 'ip_type' => 'Copyright', 'title' => 'CogSense — Cognitive Radio Spectrum Simulator Software (v2.1)', 'status_ip' => 'Granted'],
                    ['year' => '2019', 'reference_no' => 'PI2019002744', 'ip_type' => 'Patent', 'title' => 'Interference Mitigation Framework for Multi-Band Wireless Sensor Networks', 'status_ip' => 'Granted'],
                ],
                'supervision' => [
                    ['year' => '2023', 'student_name' => 'Ahmad Faris bin Zulkifli', 'level' => 'PhD', 'title' => 'Deep Reinforcement Learning for Autonomous Spectrum Management in B5G Networks', 'status' => 'Ongoing', 'repository_url' => ''],
                    ['year' => '2023', 'student_name' => 'Lim Chee Wei', 'level' => 'MSc', 'title' => 'Federated Learning-Based Intrusion Detection for IoT Wireless Networks', 'status' => 'Ongoing', 'repository_url' => ''],
                    ['year' => '2022', 'student_name' => 'Nurul Hidayah binti Kamaruddin', 'level' => 'PhD', 'title' => 'Cognitive Radio Network Optimisation Using Multi-Agent Reinforcement Learning', 'status' => 'Ongoing', 'repository_url' => ''],
                    ['year' => '2021', 'student_name' => 'Raj Kumar Subramaniam', 'level' => 'PhD', 'title' => 'Spectrum Coexistence Mechanisms for LTE-U and Wi-Fi in Unlicensed Bands', 'status' => 'Completed', 'repository_url' => 'https://utpir.utp.edu.my/id/eprint/12345'],
                    ['year' => '2021', 'student_name' => 'Siti Aisyah binti Mohd Rashid', 'level' => 'MSc', 'title' => 'Machine Learning Techniques for Channel Estimation in OFDM Systems', 'status' => 'Completed', 'repository_url' => 'https://utpir.utp.edu.my/id/eprint/12400'],
                    ['year' => '2020', 'student_name' => 'Mohamad Izzul bin Mohd Isa', 'level' => 'PhD', 'title' => 'Energy Harvesting-Enabled Cognitive Radio Networks for Green IoT', 'status' => 'Completed', 'repository_url' => 'https://utpir.utp.edu.my/id/eprint/11872'],
                    ['year' => '2019', 'student_name' => 'Teh Jing Wei', 'level' => 'MSc', 'title' => 'Interference Alignment Techniques for Device-to-Device Communication in 5G', 'status' => 'Completed', 'repository_url' => 'https://utpir.utp.edu.my/id/eprint/11301'],
                ],
                'memberships'      => ['IEEE Fellow', 'IEEE Communications Society', 'IEEE Vehicular Technology Society', 'Institution of Engineers Malaysia (IEM) Fellow'],
                'university_activities' => ['Senate Member', 'Postgraduate Studies Committee Chair', 'Research Management Centre Board Member'],
                'grant_evaluations' => ['MOSTI TechFund Panel Member', 'FRGS Grant Evaluator', 'PETRONAS Research Technical Committee'],
                'courses_teaching' => [
                    ['year' => '2024/2025', 'course_code' => 'EEE 5143', 'course_name' => 'Advanced Wireless Communications'],
                    ['year' => '2024/2025', 'course_code' => 'EEE 4183', 'course_name' => 'Telecommunications Systems Design'],
                    ['year' => '2023/2024', 'course_code' => 'EEE 5143', 'course_name' => 'Advanced Wireless Communications'],
                    ['year' => '2023/2024', 'course_code' => 'EEE 4183', 'course_name' => 'Telecommunications Systems Design'],
                    ['year' => '2023/2024', 'course_code' => 'EEE 3113', 'course_name' => 'Signals & Systems'],
                    ['year' => '2022/2023', 'course_code' => 'EEE 5153', 'course_name' => 'Cognitive Radio Networks'],
                    ['year' => '2022/2023', 'course_code' => 'EEE 4183', 'course_name' => 'Telecommunications Systems Design'],
                ],
                'other_links' => [
                    ['label' => 'Google Scholar', 'url' => 'https://scholar.google.com'],
                    ['label' => 'ResearchGate', 'url' => 'https://www.researchgate.net'],
                ],
                'publications'     => [
                    ['title' => 'Energy detection based spectrum sensing in cognitive radio networks', 'authors' => 'Idris I., et al.', 'year' => 2022, 'journal' => 'IEEE Transactions on Cognitive Communications and Networking', 'type' => 'journal'],
                    ['title' => 'Machine learning for dynamic spectrum access: A comprehensive survey', 'authors' => 'Idris I., Nursyarizal M.N., Ahmad Z.', 'year' => 2021, 'journal' => 'IEEE Communications Surveys & Tutorials', 'volume' => '23', 'type' => 'journal'],
                    ['title' => 'Cooperative spectrum sensing with multiple antennas in fading channels', 'authors' => 'Idris I., et al.', 'year' => 2019, 'journal' => 'IET Communications', 'volume' => '13', 'type' => 'journal'],
                    ['title' => 'Deep reinforcement learning for autonomous network management in 5G', 'authors' => 'Idris I., Lim C.M.', 'year' => 2020, 'journal' => 'Computer Networks', 'type' => 'journal'],
                ],
            ],

            // 6
            [
                'slug'            => 'nasreen-badruddin',
                'name'            => 'Nasreen binti Badruddin',
                'title'           => 'Associate Professor',
                'email'           => 'nasreen@utp.edu.my',
                'phone'           => '+60 5-368 7721',
                'department'      => 'Electrical & Electronics Engineering',
                'institute'       => 'Institute of Emerging Digital Technologies',
                'centre'          => 'Center for Intelligent Signal & Imaging Research (CISIR)',
                'office_address'  => "23-01-012\nUniversiti Teknologi PETRONAS\nBandar Seri Iskandar, 32610\nPerak",
                'biography'       => 'Dr. Nasreen binti Badruddin is an active researcher in computer vision, image processing, and medical imaging. She has collaborated extensively with local hospitals to develop AI-based diagnostic tools. Her work on brain tumour segmentation using deep learning has received international recognition.',
                'specializations' => ['Computer Vision', 'Medical Image Processing', 'Deep Learning', 'Brain-Computer Interface', 'Pattern Recognition'],
                'qualifications'  => [
                    '2007, PhD in Computer Vision by University of Nottingham, UK',
                    '2002, Master of Science in Image Processing by Universiti Teknologi Malaysia',
                    '1999, Bachelor of Electrical Engineering by Universiti Teknologi Malaysia',
                ],
                'scopus_documents' => 71,
                'scopus_citations' => 980,
                'scopus_hindex'    => 16,
                'scopus_coauthors' => 120,
                'gscholar_citations' => 1150,
                'gscholar_hindex'  => 18,
                'researchgate_profile' => 'Nasreen-Badruddin',
                'rg_publications'  => 71,
                'rg_citations'     => 940,
                'rg_reads'         => 31200,
                'research_projects' => [
                    'Deep Learning for Brain Tumour Segmentation (Ministry of Health, RM 420,000)',
                    'Retinal Disease Detection using Fundus Imaging (MOSTI, RM 310,000)',
                ],
                'courses_teaching' => ['EEE 3246 - Digital Image Processing', 'EEE 4246 - Computer Vision', 'EEE 5266 - Advanced Machine Learning'],
                'memberships'      => ['IEEE Signal Processing Society', 'IEEE Engineering in Medicine and Biology Society', 'Malaysian Society for Engineering Technology'],
                'publications'     => [
                    ['title' => 'Automated brain tumour segmentation from MRI using U-Net with attention mechanism', 'authors' => 'Nasreen B., et al.', 'year' => 2022, 'journal' => 'Computers in Biology and Medicine', 'volume' => '140', 'type' => 'journal'],
                    ['title' => 'Transfer learning for diabetic retinopathy classification using fundus images', 'authors' => 'Nasreen B., Wan Khairul A.', 'year' => 2021, 'journal' => 'Medical & Biological Engineering & Computing', 'type' => 'journal'],
                    ['title' => 'A survey on deep learning for medical image segmentation', 'authors' => 'Nasreen B., et al.', 'year' => 2020, 'journal' => 'Neurocomputing', 'volume' => '420', 'type' => 'journal'],
                ],
            ],

            // 7
            [
                'slug'            => 'nor-zaihar-yahaya',
                'name'            => 'Nor Zaihar bin Yahaya',
                'title'           => 'Associate Professor',
                'email'           => 'norzaihar@utp.edu.my',
                'phone'           => '+60 5-368 7412',
                'department'      => 'Electrical & Electronics Engineering',
                'institute'       => 'Institute of Smart & Sustainable Living',
                'centre'          => 'Centre of Renewable Intelligent Sustainable Power (CRISP)',
                'office_address'  => "23-02-010\nUniversiti Teknologi PETRONAS\nBandar Seri Iskandar, 32610\nPerak",
                'biography'       => 'Dr. Nor Zaihar is a leading expert in power quality, energy storage systems and electric vehicles. He has been involved in several consultancy projects with TNB, SEDA and Petronas. His research group is one of the most active in Malaysia for EV charging infrastructure design and battery management systems.',
                'specializations' => ['Power Quality', 'Energy Storage Systems', 'Electric Vehicles', 'Battery Management', 'Power Electronics'],
                'qualifications'  => [
                    '2006, PhD in Power Electronics by University of Manchester, UK',
                    '2001, Master of Engineering by Universiti Teknologi Malaysia',
                    '1998, Bachelor of Electrical Engineering by Universiti Putra Malaysia',
                ],
                'scopus_documents' => 68,
                'scopus_citations' => 730,
                'scopus_hindex'    => 15,
                'scopus_coauthors' => 95,
                'gscholar_citations' => 895,
                'gscholar_hindex'  => 16,
                'research_projects' => [
                    'Fast Charging Infrastructure for EV in Malaysia (MITI, RM 750,000)',
                    'Second-Life Battery Repurposing for Grid Storage (SEDA, RM 430,000)',
                    'Vehicle-to-Grid (V2G) Technology for Malaysian Grid (TNB, RM 390,000)',
                ],
                'industrial_experience' => "Consultant to TNB Research Sdn Bhd on Power Quality Studies (2015–present)\nTechnical Advisor, SEDA Malaysia EV Task Force (2018–2021)",
                'courses_teaching' => ['EEE 3243 - Power Electronics', 'EEE 4243 - Electric Drives', 'EEE 4253 - Renewable Energy & Storage'],
                'memberships'      => ['IEEE Power Electronics Society', 'IEEE Industry Applications Society', 'Energy Institute Malaysia'],
                'publications'     => [
                    ['title' => 'Optimal charging scheduling for EV fleets in smart grids using genetic algorithm', 'authors' => 'Nor Zaihar Y., et al.', 'year' => 2022, 'journal' => 'Sustainable Energy Technologies and Assessments', 'type' => 'journal'],
                    ['title' => 'State of health estimation for lithium-ion batteries using neural network', 'authors' => 'Nor Zaihar Y., Mohd Haris M.K.', 'year' => 2021, 'journal' => 'Journal of Energy Storage', 'volume' => '40', 'type' => 'journal'],
                ],
            ],

        ];

        foreach ($scholars as $data) {
            $publications = $data['publications'] ?? [];
            unset($data['publications']);

            $academic = Academic::updateOrCreate(['slug' => $data['slug']], $data);

            // Clear existing publications before re-seeding
            $academic->publications()->delete();
            foreach ($publications as $pub) {
                $academic->publications()->create($pub);
            }
        }
    }
}
