<div class="restaurantPopup">
            <div class="formPopup" id="popupForm">
                <form action="../actions/action_add_restaurant.php" class="formContainer" method="post">
                    <h1>Criar Restaurante</h1>
                    <div class="input_group" style="margin-bottom: 0px;">
                        <label for="rest_name">Nome</label>
                        <input type="text" placeholder="Restaurant name" name="rest_name" required>
                    </div>
                    <div class="input_group" style="margin-bottom: 0px;">
                        <label for="rest_address">Morada</label>
                        <input type="text" placeholder="Restaurant address" name="rest_address" required>
                    </div>
                    <div class="input_group" style="margin-bottom: 0px;">
                        <label for="category" form="edit_restaurant">Categoria</label>
                        <select name="category">
                            <?php 
                            $categories = getCategories();
                            $number_of_categories = count($categories);
                            if ($number_of_categories > 0) {
                                foreach ($categories as $category) {?>
                                    <option value="<?=$category['category'];?>"><?=$category['category']; ?></option><?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <button class="submit" type="submit">Criar Restaurante</button>
                    <button type="button" class="btn cancel" onclick="closeForm()">Cancelar</button>
                </form>
            </div>
        </div>
        <script>
            function openForm() {
                document.getElementById("popupForm").style.display = "block";
            }

            function closeForm() {
                document.getElementById("popupForm").style.display = "none";
            }
        </script>
