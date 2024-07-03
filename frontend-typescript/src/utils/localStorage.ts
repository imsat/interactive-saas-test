export const isBrowser: boolean = typeof window !== "undefined";
export const isServer: boolean = false;

export const set = (key: string, value: any): void => {
    if (isBrowser) {
        localStorage?.setItem(key, JSON.stringify(value));
    }
};

export const get = (key: string): any | null => {
    let res: string | null = null;
    if (isBrowser) {
        res = localStorage?.getItem(key);
    }
    if (res === undefined || res === null) return null;
    return JSON.parse(res);
};

export const remove = (key: string): void => {
    if (isBrowser) {
        localStorage?.removeItem(key);
    }
};

export const clear = (): void => {
    if (isBrowser) {
        localStorage?.clear();
    }
};
