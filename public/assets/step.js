$(document).ready(function() {
    ///////////////////////////// Step 2 /////////////////////////////////////
        // xử lý khung nhập số điện thoại
        var countries = [
            { name: "United States", iso2: "us", dialCode: "1", format: "(...) ...-...." }, // (123) 456-7890
            { name: "Canada", iso2: "ca", dialCode: "1", format: "(...) ...-...." }, // (123) 456-7890
            { name: "Vietnam", iso2: "vn", dialCode: "84", format: "... ... ..."}, // 0123 456 789
            { name: "Afghanistan", iso2: "af", dialCode: "93", format: "(..) ...-...." }, // (20) 123-4567
            { name: "Albania", iso2: "al", dialCode: "355", format: "(...) ...-..." }, // (223) 123-456
            { name: "Algeria", iso2: "dz", dialCode: "213", format: "(...) ...-...." }, // (213) 123-4567
            { name: "Andorra", iso2: "ad", dialCode: "376", format: "..." }, // 123456
            { name: "Angola", iso2: "ao", dialCode: "244", format: "(...) ...-..." }, // (923) 123-456
            { name: "Argentina", iso2: "ar", dialCode: "54", format: "(..) ....-...." }, // (11) 1234-5678
            { name: "Armenia", iso2: "am", dialCode: "374", format: "(..) ...-...." }, // (10) 123-4567
            { name: "Australia", iso2: "au", dialCode: "61", format: "(...) ...-..." }, // (412) 345-678
            { name: "Austria", iso2: "at", dialCode: "43", format: "(...) ...-...." }, // (123) 456-7890
            { name: "Azerbaijan", iso2: "az", dialCode: "994", format: "(..) ...-...." }, // (12) 123-4567
            { name: "Bahamas", iso2: "bs", dialCode: "1242", format: "(...) ...-...." }, // (242) 123-4567
            { name: "Bahrain", iso2: "bh", dialCode: "973", format: "(...) ...-..." }, // (394) 123-456
            { name: "Bangladesh", iso2: "bd", dialCode: "880", format: "(...) ...-...." }, // (171) 123-4567
            { name: "Belarus", iso2: "by", dialCode: "375", format: "(..) ...-...." }, // (25) 123-4567
            { name: "Belgium", iso2: "be", dialCode: "32", format: "(...) ...-..." }, // (123) 456-789
            { name: "Belize", iso2: "bz", dialCode: "501", format: "(...) ...-...." }, // (610) 123-4567
            { name: "Benin", iso2: "bj", dialCode: "229", format: "(..) ..-.." }, // (21) 12-34
            { name: "Bhutan", iso2: "bt", dialCode: "975", format: "(...) ...-..." }, // (17) 123-456
            { name: "Bolivia", iso2: "bo", dialCode: "591", format: "(...) ...-..." }, // (221) 123-456
            { name: "Bosnia and Herzegovina", iso2: "ba", dialCode: "387", format: "(..) ...-..." }, // (33) 123-456
            { name: "Botswana", iso2: "bw", dialCode: "267", format: "(..) ...-..." }, // (71) 123-456
            { name: "Brazil", iso2: "br", dialCode: "55", format: "(..) ....-...." }, // (11) 1234-5678
            { name: "Brunei", iso2: "bn", dialCode: "673", format: "(...) ...-..." }, // (711) 234-567
            { name: "Bulgaria", iso2: "bg", dialCode: "359", format: "(...) ...-..." }, // (882) 123-456
            { name: "Burkina Faso", iso2: "bf", dialCode: "226", format: "(..) ..-.." }, // (20) 12-34
            { name: "Burundi", iso2: "bi", dialCode: "257", format: "(...) ...-..." }, // (799) 123-456
            { name: "Cambodia", iso2: "kh", dialCode: "855", format: "(...) ...-..." }, // (92) 123-456
            { name: "Cameroon", iso2: "cm", dialCode: "237", format: "(...) ...-..." }, // (222) 123-456
            { name: "Chile", iso2: "cl", dialCode: "56", format: "(..) ....-...." }, // (22) 1234-5678
            { name: "China", iso2: "cn", dialCode: "86", format: "(...) ....-...." }, // (138) 1234-5678
            { name: "Colombia", iso2: "co", dialCode: "57", format: "(...) ...-...." }, // (300) 123-4567
            { name: "Congo", iso2: "cg", dialCode: "242", format: "(...) ...-..." }, // (06) 123-456
            { name: "Costa Rica", iso2: "cr", dialCode: "506", format: "(...) ...-...." }, // (2222) 1234
            { name: "Croatia", iso2: "hr", dialCode: "385", format: "(...) ...-..." }, // (91) 123-456
            { name: "Cuba", iso2: "cu", dialCode: "53", format: "(...) ...-..." }, // (52) 123-456
            { name: "Cyprus", iso2: "cy", dialCode: "357", format: "(..) ......." }, // (22) 123456
            { name: "Czech Republic", iso2: "cz", dialCode: "420", format: "(...) ...-..." }, // (601) 123-456
            { name: "Denmark", iso2: "dk", dialCode: "45", format: "(..) .. .. .." }, // (12) 34 56 78
            { name: "Dominican Republic", iso2: "do", dialCode: "1", format: "(...) ...-...." }, // (809) 123-4567
            { name: "Ecuador", iso2: "ec", dialCode: "593", format: "(..) ....-...." }, // (22) 1234-567
            { name: "Egypt", iso2: "eg", dialCode: "20", format: "(...) ...-...." }, // (12) 123-4567
            { name: "El Salvador", iso2: "sv", dialCode: "503", format: "(....) ...." }, // (2222) 1234
            { name: "Estonia", iso2: "ee", dialCode: "372", format: "(...) ...-..." }, // (512) 345-67
            { name: "Ethiopia", iso2: "et", dialCode: "251", format: "(..) ...-...." }, // (11) 123-4567
            { name: "Finland", iso2: "fi", dialCode: "358", format: "(..) ....-..." }, // (50) 1234-567
            { name: "France", iso2: "fr", dialCode: "33", format: "(...) ..-..-..." }, // (01) 23-45-678
            { name: "Gabon", iso2: "ga", dialCode: "241", format: "(..) ..-.." }, // (11) 12-34
            { name: "Gambia", iso2: "gm", dialCode: "220", format: "(...) ...-..." }, // (222) 123-456
            { name: "Georgia", iso2: "ge", dialCode: "995", format: "(...) ...-..." }, // (555) 123-456
            { name: "Germany", iso2: "de", dialCode: "49", format: "(...) ....-...." }, // (30) 1234-5678
            { name: "Ghana", iso2: "gh", dialCode: "233", format: "(...) ...-..." }, // (24) 123-456
            { name: "Greece", iso2: "gr", dialCode: "30", format: "(...) ...-..." }, // (210) 123-456
            { name: "Guatemala", iso2: "gt", dialCode: "502", format: "(...) ...-...." }, // (502) 1234-5678
            { name: "Guinea", iso2: "gn", dialCode: "224", format: "(...) ...-..." }, // (621) 123-456
            { name: "Honduras", iso2: "hn", dialCode: "504", format: "(....) ...." }, // (2222) 1234
            { name: "Hong Kong", iso2: "hk", dialCode: "852", format: ".... ...." }, // 1234 5678
            { name: "Hungary", iso2: "hu", dialCode: "36", format: "(...) ...-..." }, // (30) 123-456
            { name: "Iceland", iso2: "is", dialCode: "354", format: "(...) ...-..." }, // (551) 123-456
            { name: "India", iso2: "in", dialCode: "91", format: "(...) ...-...." }, // (98) 1234-5678
            { name: "Indonesia", iso2: "id", dialCode: "62", format: "(...) ...-..." }, // (812) 123-456
            { name: "Iran", iso2: "ir", dialCode: "98", format: "(...) ...-...." }, // (912) 123-4567
            { name: "Iraq", iso2: "iq", dialCode: "964", format: "(...) ...-..." }, // (770) 123-456
            { name: "Ireland", iso2: "ie", dialCode: "353", format: "(...) ...-..." }, // (21) 123-456
            { name: "Israel", iso2: "il", dialCode: "972", format: "(...) ...-..." }, // (50) 123-456
            { name: "Italy", iso2: "it", dialCode: "39", format: "(...) ...-...." }, // (312) 123-4567
            { name: "Jamaica", iso2: "jm", dialCode: "1876", format: "(...) ...-...." }, // (876) 123-4567
            { name: "Japan", iso2: "jp", dialCode: "81", format: "(...) ...-..." }, // (90) 1234-567
            { name: "Jordan", iso2: "jo", dialCode: "962", format: "(...) ...-..." }, // (79) 123-456
            { name: "Kazakhstan", iso2: "kz", dialCode: "7", format: "(...) ...-...." }, // (771) 123-4567
            { name: "Kenya", iso2: "ke", dialCode: "254", format: "(...) ...-..." }, // (722) 123-456
            { name: "Kuwait", iso2: "kw", dialCode: "965", format: "(...) ...-..." }, // (500) 123-456
            { name: "Kyrgyzstan", iso2: "kg", dialCode: "996", format: "(...) ...-..." }, // (555) 123-456
            { name: "Laos", iso2: "la", dialCode: "856", format: "(..) ...-..." }, // (20) 123-456
            { name: "Latvia", iso2: "lv", dialCode: "371", format: "(..) ...-..." }, // (22) 123-456
            { name: "Lebanon", iso2: "lb", dialCode: "961", format: "(...) ...-..." }, // (3) 123-456
            { name: "Liberia", iso2: "lr", dialCode: "231", format: "(...) ...-..." }, // (555) 123-456
            { name: "Libya", iso2: "ly", dialCode: "218", format: "(...) ...-..." }, // (91) 123-456
            { name: "Lithuania", iso2: "lt", dialCode: "370", format: "(..) ...-..." }, // (5) 123-456
            { name: "Luxembourg", iso2: "lu", dialCode: "352", format: "(...) ...-..." }, // (27) 123-456
            { name: "Macedonia", iso2: "mk", dialCode: "389", format: "(...) ...-..." }, // (2) 123-456
            { name: "Madagascar", iso2: "mg", dialCode: "261", format: "(..) ....." }, // (20) 12345
            { name: "Malaysia", iso2: "my", dialCode: "60", format: "(...) ...-...." }, // (12) 123-4567
            { name: "Malta", iso2: "mt", dialCode: "356", format: "(...) ...-..." }, // (22) 123-456
            { name: "Mexico", iso2: "mx", dialCode: "52", format: "(...) ...-...." }, // (55) 1234-5678
            { name: "Moldova", iso2: "md", dialCode: "373", format: "(...) ...-..." }, // (22) 123-456
            { name: "Monaco", iso2: "mc", dialCode: "377", format: "(...) ...-..." }, // (6) 123-456
            { name: "Mongolia", iso2: "mn", dialCode: "976", format: "(...) ...-..." }, // (881) 123-456
            { name: "Morocco", iso2: "ma", dialCode: "212", format: "(...) ...-...." }, // (6) 123-4567
            { name: "Mozambique", iso2: "mz", dialCode: "258", format: "(...) ...-..." }, // (82) 123-456
            { name: "Myanmar", iso2: "mm", dialCode: "95", format: "(...) ...-..." }, // (9) 123-456
            { name: "Namibia", iso2: "na", dialCode: "264", format: "(...) ...-..." }, // (81) 123-456
            { name: "Nepal", iso2: "np", dialCode: "977", format: "(...) ...-..." }, // (980) 123-456
            { name: "Netherlands", iso2: "nl", dialCode: "31", format: "(...) ...-..." }, // (6) 123-456
            { name: "New Zealand", iso2: "nz", dialCode: "64", format: "(...) ...-..." }, // (21) 123-456
            { name: "Nicaragua", iso2: "ni", dialCode: "505", format: "(...) ...-...." }, // (505) 1234-5678
            { name: "Niger", iso2: "ne", dialCode: "227", format: "(..) ....." }, // (20) 12345
            { name: "Nigeria", iso2: "ng", dialCode: "234", format: "(...) ...-..." }, // (802) 123-456
            { name: "Norway", iso2: "no", dialCode: "47", format: "(...) ...-..." }, // (12) 34-56-78
            { name: "Oman", iso2: "om", dialCode: "968", format: "(...) ...-..." }, // (92) 123-456
            { name: "Pakistan", iso2: "pk", dialCode: "92", format: "(...) ...-...." }, // (21) 1234-5678
            { name: "Panama", iso2: "pa", dialCode: "507", format: "(...) ...-...." }, // (222) 1234-567
            { name: "Paraguay", iso2: "py", dialCode: "595", format: "(...) ...-..." }, // (21) 123-456
            { name: "Peru", iso2: "pe", dialCode: "51", format: "(...) ...-..." }, // (1) 123-456
            { name: "Philippines", iso2: "ph", dialCode: "63", format: "(...) ...-...." }, // (912) 123-4567
            { name: "Poland", iso2: "pl", dialCode: "48", format: "(...) ...-..." }, // (22) 123-456
            { name: "Portugal", iso2: "pt", dialCode: "351", format: "(...) ...-..." }, // (21) 123-456
            { name: "Qatar", iso2: "qa", dialCode: "974", format: "(...) ...-..." }, // (33) 123-456
            { name: "Romania", iso2: "ro", dialCode: "40", format: "(...) ...-..." }, // (21) 123-456
            { name: "Russia", iso2: "ru", dialCode: "7", format: "(...) ...-...." }, // (911) 123-4567
            { name: "Rwanda", iso2: "rw", dialCode: "250", format: "(...) ...-..." }, // (78) 123-456
            { name: "Saudi Arabia", iso2: "sa", dialCode: "966", format: "(...) ...-..." }, // (50) 123-456
            { name: "Senegal", iso2: "sn", dialCode: "221", format: "(...) ...-..." }, // (77) 123-456
            { name: "Serbia", iso2: "rs", dialCode: "381", format: "(...) ...-..." }, // (62) 123-456
            { name: "Singapore", iso2: "sg", dialCode: "65", format: "(...) ...." }, // (12) 3456
            { name: "Slovakia", iso2: "sk", dialCode: "421", format: "(...) ...-..." }, // (2) 123-456
            { name: "Slovenia", iso2: "si", dialCode: "386", format: "(...) ...-..." }, // (1) 123-456
            { name: "South Africa", iso2: "za", dialCode: "27", format: "(...) ...-...." }, // (11) 1234-567
            { name: "South Korea", iso2: "kr", dialCode: "82", format: "(...) ...-...." }, // (10) 1234-5678
            { name: "Spain", iso2: "es", dialCode: "34", format: "(...) ...-..." }, // (91) 123-456
            { name: "Sri Lanka", iso2: "lk", dialCode: "94", format: "(...) ...-..." }, // (21) 123-456
            { name: "Sudan", iso2: "sd", dialCode: "249", format: "(...) ...-..." }, // (91) 123-456
            { name: "Sweden", iso2: "se", dialCode: "46", format: "(...) ...-...." }, // (8) 1234-5678
            { name: "Switzerland", iso2: "ch", dialCode: "41", format: "(...) ...-...." }, // (44) 1234-567
            { name: "Syria", iso2: "sy", dialCode: "963", format: "(...) ...-..." }, // (11) 123-456
            { name: "Taiwan", iso2: "tw", dialCode: "886", format: "(...) ......." }, // (912) 123456
            { name: "Tanzania", iso2: "tz", dialCode: "255", format: "(...) ...-..." }, // (22) 123-456
            { name: "Thailand", iso2: "th", dialCode: "66", format: "(...) ...-...." }, // (2) 1234-567
            { name: "Tunisia", iso2: "tn", dialCode: "216", format: "(...) ...-..." }, // (71) 123-456
            { name: "Turkey", iso2: "tr", dialCode: "90", format: "(...) ...-...." }, // (212) 1234-5678
            { name: "Uganda", iso2: "ug", dialCode: "256", format: "(...) ...-..." }, // (772) 123-456
            { name: "Ukraine", iso2: "ua", dialCode: "380", format: "(..) ...-..." }, // (44) 123-456
            { name: "United Arab Emirates", iso2: "ae", dialCode: "971", format: "(...) ...-...." }, // (50) 123-4567
            { name: "United Kingdom", iso2: "gb", dialCode: "44", format: "(....) ......-...." }, // (020) 1234-5678
            { name: "Uruguay", iso2: "uy", dialCode: "598", format: "(...) ...-..." }, // (2) 123-456
            { name: "Uzbekistan", iso2: "uz", dialCode: "998", format: "(...) ...-..." }, // (71) 123-456
            { name: "Venezuela", iso2: "ve", dialCode: "58", format: "(...) ...-...." }, // (212) 123-4567
            { name: "Yemen", iso2: "ye", dialCode: "967", format: "(...) ...-..." }, // (71) 123-456
            { name: "Zambia", iso2: "zm", dialCode: "260", format: "(...) ...-..." }, // (21) 123-456
            { name: "Zimbabwe", iso2: "zw", dialCode: "263", format: "(...) ...-..." } // (91) 123-456
        ];
        let selectedCountry; // Biến bên ngoài hàm    
        async function getCountryByIP() {
            try {
                const response = await fetch("https://ipapi.co/json/");
                const data = await response.json();
                
                // Lấy mã quốc gia t API
                const countryCode = data.country_code.toLowerCase();
                
                // Tìm ch mục của quc gia trong mảng `countries` dựa trên mã iso2
                var countryIndex = countries.findIndex(country => country.iso2 === countryCode);
                
                // Nếu tìm thấy, trả về chỉ mục, nếu không trả về 0 (Hoa Kỳ)
                return countryIndex !== -1 ? countryIndex : 0;  // Trả về 0 nếu không tìm thấy (Hoa Kỳ)
                
            } catch (error) {
                console.error('Lỗi khi lấy quốc gia từ IP:', error);
        
                // Trả v chỉ mục của quốc gia mặc đnh (Hoa Kỳ) nếu có lỗi
                return 0;
            }
        }
    
    // Cập nhật giao diện sau khi có kết quả từ getCountryByIP()
    getCountryByIP().then(index_Country => {
        var selectedCountry = countries[index_Country];
        
        // In ra quốc gia đã chọn
        console.log(`Quốc gia đã chọn: ${selectedCountry.name}, Mã quốc gia: ${selectedCountry.dialCode}`);
    
        // Gọi hàm để cập nhật giao diện với quốc gia đã chọn
        update_first_country(selectedCountry);
    });
    
    function renderDropdown() {
        $('#countryDropdown').empty(); // Xóa nội dung hiện tại trong danh sách quốc gia
        countries.forEach(function(country) {
            var listItem = $('<li>')
                .addClass('country')
                .html(`
                    <div class="flag ${country.iso2}"></div>
                    <span class="country-name">${country.name}</span>
                    <span class="dial-code">+${country.dialCode}</span>
                `)
                .data('country', country)
                .click(function() {
                    selectCountry(country);
                });
            $('#countryDropdown').append(listItem);
        });
    }
    
    function update_first_country(country){
        $('#flagIcon').attr('class', 'flag ' + country.iso2); // Cập nhật cờ quốc gia
        $('#phoneInput').val('+' + country.dialCode + ' '); // Cập nhật mã quốc gia trong ô input
        selectedCountry = country; // Gán giá trị cho biến bên ngoài
    }  
      
      
    function selectCountry(country) {
        selectedCountry = country;
        $('#flagIcon').attr('class', 'flag ' + country.iso2); // Cập nhật cờ quốc gia
        $('#phoneInput').val('+' + country.dialCode + ' '); // Cập nhật mã quốc gia trong ô input
        $('#countryDropdown').toggleClass('hide'); // Ẩn dropdown sau khi chọn
    }
        
        function formatPhoneNumber(phone, isBackspace = false) {
            // Nếu là phím Backspace, bỏ qua định dạng
            if (isBackspace) {
                console.log(phone +" ok ")
                return phone; // Không thay đổi gì và trả về số gốc
            }
        
            var formattedPhone = phone.replace(/\D/g, ''); // Loại b ký tự không phải số
            
            // Kiểm tra nếu số điện thoại rỗng hoặc không đủ ký tự
            if (formattedPhone.length === 0) {
                return ''; // Nếu số điện thoại rỗng, trả về chuỗi rỗng
            }
        
            if (selectedCountry && formattedPhone.startsWith(selectedCountry.dialCode)) {
                formattedPhone = formattedPhone.substring(selectedCountry.dialCode.length); // Loại bỏ mã vùng
                var formatPattern = selectedCountry.format; // Lấy ịnh dạng của quốc gia
                var formattedNumber = '';
            
                var phoneIndex = 0; // Vị trí ca ký tự trong số điện thoại
                for (var i = 0; i < formatPattern.length; i++) {
                    if (formatPattern[i] === '.') {
                        if (phoneIndex < formattedPhone.length) {
                            formattedNumber += formattedPhone[phoneIndex];
                            phoneIndex++;
                        }
                    } else {
                        formattedNumber += formatPattern[i];
                    }
                }
            
                return '+' + selectedCountry.dialCode + ' ' + formattedNumber.trim();
            }
            return phone;
        }
        
        $('#phoneInput').on('keydown', function(e) {
            var cursorPosition = this.selectionStart;
            var countryDialCodeLength = ('+' + selectedCountry.dialCode + ' ').length;
    
            // Chỉ ngăn việc chỉnh sửa nếu con trỏ đang ở vị trí trước hoặc trong mã quốc gia
            if (cursorPosition < countryDialCodeLength && (e.key !== 'ArrowRight' && e.key !== 'Tab')) {
                e.preventDefault(); // Ngăn không cho người dùng chỉnh sửa mã quốc gia
            }
            if (e.key === 'ArrowLeft' || e.key === " "){
                if (cursorPosition <= countryDialCodeLength ){
                    e.preventDefault();
                    this.setSelectionRange(cursorPosition, cursorPosition); // Đặt li con trỏ sau khi xóa
                }
            }
            var currentValue = $(this).val();
            var newValue = currentValue;
    
        // Kiểm tra xem ký t trước con trỏ có phải là dấu phân cách (khoảng trắng, dấu ngoặc, gạch ngang) hay không
        if ([' ', '-', '(', ')'].includes(currentValue[cursorPosition - 1])) {
            if (e.key === 'Backspace') {
                if (cursorPosition > countryDialCodeLength){
                    console.log(cursorPosition);
                // Nếu là phím Backspace, xóa ký tự trước con trỏ
                newValue = currentValue.substring(0, cursorPosition - 1);
                $(this).val(formatPhoneNumber(newValue, true));
                e.preventDefault();
                this.setSelectionRange(cursorPosition, cursorPosition); // Đặt lại con trỏ sau khi xóa
            }else{
                e.preventDefault();
            }
            }
        }
        });
        
    
        
            // Hiển thị dropdown quốc gia khi click vào flag
            $('#selectedFlag').click(function() {
                $('#countryDropdown').toggleClass('hide');
            });
        
    // Xử lý khi nhập số điện thoại
    $('#phoneInput').on('input', function(e) {
        var inputValue = $(this).val();
    
        // Kiểm tra xem có phải người dùng nhấn phím Backspace không
        if (e.originalEvent && e.originalEvent.inputType === 'deleteContentBackward') {
            // Nếu l Backspace, không thực hiện định dạng
            return;
        }
    
        // Nếu người dùng cố gắng xóa mã quc gia, nó sẽ được tự động thêm lại
        if (!inputValue.startsWith('+' + selectedCountry.dialCode + ' ')) {
            $(this).val('+' + selectedCountry.dialCode + ' ');
        } else {
            // Thực hiện định dạng nếu không phi Backspace
            $(this).val(formatPhoneNumber(inputValue, false));
        }
    });
    
        
            // Render danh sách quc gia
            renderDropdown();
    
    
        ///////////////////////////// Step 3 /////////////////////////////////////
    
    });
    