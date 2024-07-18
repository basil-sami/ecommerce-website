import os

def rename_images(folder_path):
    # Get a list of all files in the folder
    files = os.listdir(folder_path)
    
    # Filter out only image files (assuming common image formats)
    image_files = [f for f in files if f.lower().endswith(('.png', '.jpg', '.jpeg', '.gif', '.bmp'))]
    
    # Loop through the image files and rename them
    for i, filename in enumerate(image_files):
        # Create the new filename
        new_filename = f"product{i}.jpg"
        
        # Create the full paths to the old and new files
        old_file_path = os.path.join(folder_path, filename)
        new_file_path = os.path.join(folder_path, new_filename)
        
        # Rename the file
        os.rename(old_file_path, new_file_path)
        print(f'Renamed "{filename}" to "{new_filename}"')

# Example usage
folder_path = 'C:/xampp/htdocs/ecommerce-website/storage/app/public/product_images'
rename_images(folder_path)
