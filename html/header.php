<?php //DEV & LOCAL ? element('mode_developpement',['db_name' => $b_db_name, 'session_utilisateur' => $b_session_utilisateur]) : '';             ?>
<div id="header">
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-header">
                    <span class="sr-only">Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="./">
                    <?= $b_name_projet; ?>
                </a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-header">
                <ul class="nav navbar-nav">
                    <li class="dropdown <?= selected($b_page, ['catalogue']) ? 'active' : ''; ?>">
                        <a href="./?p=catalogue"  role="button" aria-expanded="false">
                            <span class="glyphicon glyphicon-list" aria-hidden="true"></span>
                            Projet
                        </a>
                    </li>

                    <li class="dropdown <?= selected($b_page, ['synthese', 'liste-des-etudes', 'nouvelle-etude', 'appariement']) ? 'active' : ''; ?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <span class="glyphicon glyphicon-list" aria-hidden="true"></span>
                            Etudes
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <?php if (check_user_right($b_user_rights, $b_session_utilisateur['profile'], 'synthese')) : ?>
                                <li class="<?= selected($b_page, 'synthese') ? 'active' : ''; ?>"><a href="./?p=synthese">Synthèse</a></li> 
                            <?php endif; ?>
                            <?php if (check_user_right($b_user_rights, $b_session_utilisateur['profile'], 'liste-des-etudes')) : ?>
                                <li class="<?= selected($b_page, 'liste-des-etudes') ? 'active' : ''; ?>"><a href="./?p=liste-des-etudes">Liste des études</a></li>
                            <?php endif; ?>
                            <!--
                            <?php if (check_user_right($b_user_rights, $b_session_utilisateur['profile'], 'nouvelle_etude')) : ?>
                                              <li class="<?= selected($b_page, 'nouvelle-etude') ? 'active' : ''; ?>"><a href="./?p=nouvelle-etude">Ajouter une étude</a></li>
                            <?php endif; ?> -->

                            <?php if ($b_liste_des_etudes) : ?>
                                <li class="divider"></li>
                            <?php endif; ?>

                            <?php
                            foreach ($b_liste_des_etudes as $etude):
                                if (check_user_right($b_user_rights, $b_session_utilisateur['profile'], 'appariement')) :
                                    ?>
                                    <li ><a href="./?p=appariement&nom_etude=<?= $etude['nom_etude'] ?>"><?= $etude['nom_etude'] ?></a></li>
                                    <?php
                                endif;
                            endforeach;
                            ?>  
                        </ul>
                    </li>

                    <!-- UTILISATEURS -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                            Utilisateurs 
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li role="presentation" class="dropdown-header" >
                                Connecter en tant que: <span class="text-primary"><?= $b_session_utilisateur['nom'] . ' ' . $b_session_utilisateur['prenom']; ?></span>
                            </li>
                            <li role="presentation" class="dropdown-header" >
                                Type de droit: <span class="text-primary"><?= $b_profiles_utilisateurs[$b_session_utilisateur['profile']]; ?></span>
                            </li>
                            <li role="presentation" class="dropdown-header" id="disconnect-time" >
                                Déconnexion dans: <span class="text-danger logout-time"><?= TIMEOUT; ?></span>
                            </li>

                        </ul>
                    </li>
                    <!-- ADMINISTRATION -->
                    <?php if (check_user_right($b_user_rights, $b_session_utilisateur['profile'], 'Administration')) : ?>
                        <li class="dropdown <?= selected($b_page, ['utilisateurs', 'gestion-projets']) ? 'active' : ''; ?>">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <span class="glyphicon glyphicon-tasks" aria-hidden="true"></span>
                                Administration
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">               
                                <!--<?php if (check_user_right($b_user_rights, $b_session_utilisateur['profile'], 'utilisateurs')) : ?>
                                                    <li class="<?= selected($b_page, 'utilisateurs') ? 'active' : ''; ?>"><a href="./?p=utilisateurs">Gestion Des utilisateurs</a></li>  
                                <?php endif; ?> -->
                                <?php if (check_user_right($b_user_rights, $b_session_utilisateur['profile'], 'gestion-projets')) : ?>
                                    <li class="<?= selected($b_page, 'gestion-projets') ? 'active' : ''; ?>"><a href="./?p=gestion-projets">Gestion des projets</a></li> 
                                <?php endif; ?>
                                <?php if (check_user_right($b_user_rights, $b_session_utilisateur['profile'], 'ajouter-projet')) : ?>
                                    <li class="divider"></li>
                                    <li class="<?= selected($b_page, 'ajouter-projet') ? 'active' : ''; ?>" id="ajouter-projet-opener" >
                                        <a href="./?p=ajouter-projet">
                                            Ajouter un projet
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if (check_user_right($b_user_rights, $b_session_utilisateur['profile'], 'changer-projet')) : ?>
                                    <li class="divider"></li>
                                    <li class="<?= selected($b_page, 'changer-projet') ? 'active' : ''; ?>" id="changer-projet-opener" >
                                        <a href="./?p=changer-projet">
                                            Changer de projet
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>
                    <!-- HELP -->
                    <li>
                        <a href="<?= LINK_HELP; ?>" target="_blank">
                            Aide <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>
                        </a>
                    </li>
                    <!-- DECONNEXION -->
                    <li>
                        <a href="./?p=<?= $b_deconnexion_page_name; ?>">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a>
                    </li>
                </ul>


            </div>
        </div>
    </nav>
</div>
<div class="separator">
    <br>
    <br>
</div>


