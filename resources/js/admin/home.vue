<template>
    <div>
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>MENU UTAMA</h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item active">
                            <a href="#" @click="$router.push('/')">Dashboard</a>
                        </div>
                        <div class="breadcrumb-item">
                            <a href="#">Components</a>
                        </div>
                        <div class="breadcrumb-item">Hero</div>
                    </div>
                </div>

                <div class="section-body">
                    <h2 class="section-title">Menu utama</h2>
                    <p class="section-lead">
                        Lorem ipsum, dolor sit amet consectetur adipisicing
                        elit. Expedita nam dicta beatae repellendus magni
                        sapiente, dolore ex facere hic quis laborum earum,
                        commodi unde. Pariatur, iste? Impedit pariatur quibusdam
                        iure voluptatibus quas veniam ipsam mollitia aliquam
                        blanditiis architecto, non omnis..
                    </p>

                    <div id="output-status"></div>

                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</template>
