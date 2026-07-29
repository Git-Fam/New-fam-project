declare namespace Deno {
  export namespace env {
    export function get(key: string): string | undefined;
  }

  export type ServeHandler = (request: Request) => Response | Promise<Response>;

  export interface ServeOptions {
    port?: number;
    hostname?: string;
  }

  export function serve(handler: ServeHandler): void;
  export function serve(options: ServeOptions, handler: ServeHandler): void;
}
