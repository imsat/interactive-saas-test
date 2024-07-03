import Swal, {SweetAlertOptions, SweetAlertResult} from "sweetalert2";

const alert = (options: SweetAlertOptions): void => {
    Swal.fire(options);
};

interface AlertSuccessOptions {
    title?: string;
    text?: string;
    timer?: number;
    showConfirmationButton?: boolean;
}

export const alertSuccess = ({
                                 title = "Success!",
                                 text = "That's all done!",
                                 timer = 1000,
                                 showConfirmationButton = false,
                             }: AlertSuccessOptions = {}): void => {
    alert({
        title: title,
        text: text,
        timer: timer,
        showConfirmButton: showConfirmationButton,
        icon: "success",
    });
};

interface AlertErrorOptions {
    title?: string;
    text?: string;
}

export const alertError = ({
                               title = "Error!",
                               text = "Oops...Something went wrong",
                           }: AlertErrorOptions = {}): void => {
    alert({
        title: title,
        text: text,
        icon: "error",
    });
};

export const confirm = (title: string | null = null, text?: string): Promise<SweetAlertResult> => {
    return Swal.fire({
        title: title || "Are you sure?",
        text: text || "You will not be able to revert this action!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes!",
    });
};

interface ToastOptions {
    toast?: boolean;
    icon?: "success" | "error";
    title?: string;
    position?: "top-end";
    showConfirmButton?: boolean;
    timer?: number;
    timerProgressBar?: boolean;
}

export const successToast = (msg: string, options?: ToastOptions): void => {
    const defaultOptions: ToastOptions = {
        toast: true,
        icon: "success",
        title: msg,
        position: "top-end",
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
    };
    Swal.fire({...defaultOptions, ...options});
};

export const errorToast = (msg: string, options?: ToastOptions, timer: number = 3000): void => {
    const defaultOptions: ToastOptions = {
        toast: true,
        icon: "error",
        title: msg,
        position: "top-end",
        showConfirmButton: false,
        timer: timer,
        timerProgressBar: true,
    };
    Swal.fire({...defaultOptions, ...options});
};
